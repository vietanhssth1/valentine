<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class HomeService {

    public function receiveGift($giftBox)
    {
        try {
            $gifts = [
                'DORAEMON' => '1 vé đi công viên King',
                'NOBITA' => '1 cặp áo đôi',
                'SHIZUKA' => '1 chuyến đi phượt',
                'SUNEO' => '1 hộp quà hoa lãng mạn',
            ];
            if (!$giftBox || !array_key_exists($giftBox, $gifts)) {
                throw new NotFoundHttpException();
            }
            Mail::send('receive_gift', ['gift' => $giftBox, 'content' => $gifts[$giftBox]], function($mail){
                $mail->to('vietanhelnino206@gmail.com', 'AnhTV')->subject('Van received a secret gift box!');
            });
            return ['alert' => 'Success'];
        } catch (\Exception $exception) {
            Log::error('receiveGift ' . $exception->getMessage());
            throw new UnprocessableEntityHttpException('Lỗi hệ thống');
        }

    }

    public function confirm($params)
    {
        return ['alert' => 'Success'];
        try {
            Mail::send('confirm', ['confirm' => $params['confirm'], 'rate' => $params['rate'], 'content' => $params['message']], function($mail){
                $mail->to('vietanhelnino206@gmail.com', 'AnhTV')->subject('Van confirmed!');
            });
            return ['alert' => 'Success'];
        } catch (\Exception $exception) {
            Log::error('confirm ' . $exception->getMessage());
            throw new UnprocessableEntityHttpException('Lỗi hệ thống');
        }
    }
}