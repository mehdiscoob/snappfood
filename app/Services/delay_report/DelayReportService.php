<?php

namespace App\Services\delay_report;

use App\Helpers\DateHelper;
use App\Repositories\delay_report\DelayReportRepositoryInterface;
use App\Services\order\OrderService;
use App\Services\trip\TripService;
use App\Services\user\UserService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DelayReportService
{
    private $delayReportRepository;
    private $orderService;
    private $userService;


    /**
     * DelayReportService constructor.
     *
     * @param DelayReportRepositoryInterface $delayReportRepository
     * @param OrderService $orderService
     */
    public function __construct(DelayReportRepositoryInterface $delayReportRepository, OrderService $orderService,UserService $userService)
    {
        $this->delayReportRepository = $delayReportRepository;
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    /**
     * Create a delay report for an order.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse|bool
     * @throws \Exception
     */
    public function create(array $data)
    {
        $orderHasTrips = $this->orderService->hasTrips($data['order_id']);
        $isOpenDelay = $this->delayReportRepository->openDelayReportByOrder($data['order_id']);
        $data['delay_time'] = intval(round((strtotime(now()) - strtotime($orderHasTrips->delivery_time)) / 60));
        if (Auth::id() != $orderHasTrips->user_id) return response()->json(['message' => 'Unauthorized'], 401);
        if ($data['delay_time'] < 0) return response()->json(['message' => 'Your order is not to be late, have a patience please'],200);
        if ($isOpenDelay) return response()->json(['message' => 'You have already opened report for this order'],422);
        DB::beginTransaction();
        try {
            if (isset($orderHasTrips->tripId)) {
                if ($orderHasTrips->tripStatus == "DELIVERED") return response()->json(['message' => 'The Order is delivered'],400);
                $httpClient = new Client([
                    'verify' => false,
                ]);
                $response = $httpClient->get('https://run.mocky.io/v3/2733e71a-8865-4f04-97a5-e66c42358a0e');
                $responseBody = json_decode($response->getBody()->getContents());
                $addTime = (new DateHelper())->addTimeToNow($responseBody->minutes, "minutes");
                $order = $this->orderService->update($data['order_id'], ["delivery_time" => $addTime]);
            } else {
                $data['type'] = "1";
            }
            $this->delayReportRepository->create($data);
            DB::commit();
            return response()->json(['message' => 'Delay report created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignDelayReportToAgent(): \Illuminate\Http\JsonResponse
    {
        $agent=Auth::user();
        if ($agent->role!="agent") return response()->json(['message' => "You can't access to this address"],403);

        $hasReport=$this->delayReportRepository->agentHasDelayReport($agent->id);

        if ($hasReport) return response()->json(['message' => 'You have already open report'],422);

        $update=$this->delayReportRepository->assignDelayReportToAgent($agent->id);

        return isset($update)? response()->json(['message' => 'Delay report assigned to agent successfully',"data"=>$update])
        :response()->json(['message' => 'There is no open Delay report now']);
    }


}
