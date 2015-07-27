<?php
/* 
 *     FILENAME

 *     Notes goes here...

 *     Authors:
 *     Tihomir Kamenov <tihomir.kamenov@1stonlinesolutions.com>

 *     Revision date 7/24/2015 
 */
use App\Events\OrderShippedOn;
use App\Events\OrderWasDelivered;
use App\Events\OrderWasProcessed;
use App\Order;
use App\User;
use Carbon\Carbon;

function getAdmins() {
    $admins = User::where('is_admin', 1)->get();
    return $admins;
}

function showOrderDates($order) {
    $dates = [];
    $dates[] = [ 'date' => getCarbonDate($order->created_at), 'text' => 'Ordered on' ];
    switch ($order->status) {
        case 2: #processed
            $dates[] = [ 'date' => $order->processed_on, 'text' => 'Processed on' ];
            break;
        case 3: #prepared
            $dates[] = [ 'date' => $order->processed_on, 'text' => 'Processed on' ];
            $dates[] = [ 'date' => $order->shipped_on, 'text' => 'Shipped on'];
            break;

        case 4: #travelling
            $dates[] = [ 'date' => $order->processed_on, 'text' => 'Processed on' ];
            $dates[] = [ 'date' => $order->shipped_on, 'text' => 'Shipped on'];
            $dates[] = [ 'date' => $order->expected_delivery_on, 'text' => 'Expected delivery before' ];
            break;

        case 5: #delivered
            $dates[] = [ 'date' => $order->delivered_on, 'text' => 'Delivered on' ];
            break;

        case 100: #canceled
            $dates[] = [ 'date' => getCarbonDate($order->updated_at), 'text' => 'Canceled on'];
            break;
    }
    return $dates;
}

function getCarbonDate($date) {
    if (is_null($date))
        return null;
    else
        return Carbon::parse($date)->format('d M Y H:i');
}

function updateStatus($order, $newStatus) { #used when updating order info
    $data = [];
    switch ($newStatus) {
        case 2: #processed
            $event = new OrderWasProcessed($order);
            $data['processed_on'] = Carbon::now();
            break;

        case 4: #traveling
            $event = new OrderShippedOn($order);
            $data['shipped_on'] = Carbon::now();
            $data['expected_delivery_on'] = Carbon::now()->addDay();
            break;

        case 5: #delivered
            $event = new OrderWasDelivered($order);
            $data['delivered_on'] = Carbon::now();
            break;
    }

    if (isset($event) && $event) {
        event($event);
    }

    return $data;
}

function canEdit(Order $order) {
    if (Auth::user()->is_admin) {
        return true;
    }
    return $order->status == 1 && !$order->is_paid ? true: false;
}

function canCancel(Order $order) {
    if (Auth::user()->is_admin) {
        return true;
    }
    return ($order->status == 1 || $order->status == 2 || $order->status == 3) && !$order->is_paid ? true : false; #if status is (Pending, Processed, Prepared) allow cancel
}

function canEditAddress(Order $order) {
    if (Auth::user()->is_admin) {
        return true;
    }
    return $order->status == 1 ? true : false;
}


