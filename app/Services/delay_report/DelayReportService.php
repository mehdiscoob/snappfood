<?php

namespace App\Services\delay_report;

use App\Helpers\DateHelper;
use App\Models\DelayReport;
use App\Repositories\delay_report\DelayReportRepositoryInterface;
use App\Services\order\OrderService;
use App\Services\trip\TripService;
use App\Services\user\UserService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DelayReportService implements DelayReportServiceInterface
{
    private $delayReportRepository;
    private $orderService;


    /**
     * DelayReportService constructor.
     *
     * @param DelayReportRepositoryInterface $delayReportRepository
     * @param OrderService $orderService
     */
    public function __construct(DelayReportRepositoryInterface $delayReportRepository, OrderService $orderService)
    {
        $this->delayReportRepository = $delayReportRepository;
        $this->orderService = $orderService;
    }

    /**
     * Create a delay report for an order.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function create(array $data) :bool
    {
        $orderHasTrips = $this->orderService->hasTrips($data['order_id']);
        $isOpenDelay = $this->delayReportRepository->openDelayReportByOrder($data['order_id']);
        $data['delay_time'] = intval(round((strtotime(now()) - strtotime($orderHasTrips->delivery_time)) / 60));
        $this->validateDelayCreation($orderHasTrips, $isOpenDelay, $data);
        DB::beginTransaction();
        try {
            if (isset($orderHasTrips->tripId)) {
                $this->handleDelayedOrderWithTrip($orderHasTrips, $data);
            } else {
                $data['type'] = "1";
            }
            DB::commit();
            return $this->delayReportRepository->create($data);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Validate delay report creation.
     *
     * @param mixed $orderHasTrips
     * @param mixed $isOpenDelay
     * @param array $data
     * @throws \Illuminate\Http\JsonResponse
     */
    private function validateDelayCreation($orderHasTrips, $isOpenDelay, array $data)
    {
        if (Auth::id() != $orderHasTrips->user_id) abort(401, 'Unauthorized');
        if ($data['delay_time'] < 0) abort(423, 'Your order is not to be late, have patience please');
        if ($isOpenDelay) abort(422, 'You have already opened a report for this order');

    }

    /**
     * Handle delayed order with a trip.
     *
     * @param mixed $orderHasTrips
     * @param array $data
     */
    private function handleDelayedOrderWithTrip($orderHasTrips, array $data)
    {
        if ($orderHasTrips->tripStatus == "DELIVERED") abort(400, 'The Order is delivered');
        $this->performExternalApiCallAndUpdateOrder($data);
    }

    /**
     * Perform an external API call and update the order.
     *
     * @param array $data
     */
    private function performExternalApiCallAndUpdateOrder(array $data)
    {
        $httpClient = new Client(['verify' => false]);
        $response = $httpClient->get('https://run.mocky.io/v3/2733e71a-8865-4f04-97a5-e66c42358a0e');
        $responseBody = json_decode($response->getBody()->getContents());
        $addTime = (new DateHelper())->addTimeToNow($responseBody->minutes, "minutes");
        $this->orderService->update($data['order_id'], ["delivery_time" => $addTime]);
    }

    /**
     * Get delay reports for a vendor, ordered by delay time.
     *
     * @param int $vendor_id
     * @return mixed
     */
    public function getReportByVendorOrderByDelayTime(int $vendor_id)
    {
        return $this->delayReportRepository->getByReportOrderByDelayTime($vendor_id);
    }

    /**
     * Assign an open delay report to an agent.
     *
     * @return \stdClass
     */
    public function assignDelayReportToAgent(): \stdClass
    {
        $agent = Auth::user();
        if ($agent->role != "agent") abort(403, "You can't access to this address");;

        if ($this->delayReportRepository->agentHasDelayReport($agent->id)) abort(422, 'You have already opened a report');

        $update = $this->delayReportRepository->assignDelayReportToAgent($agent->id);

        return $update ?? abort(404, 'There is no open Delay report now');
    }


}
