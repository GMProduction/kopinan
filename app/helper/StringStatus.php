<?php

namespace App\helper;

class StringStatus
{
    /**
     * @param $status
     *
     * @return string
     */
    public static function getStatusPesanan($status)
    {
        $string = '';
        switch ($status) {
            case 0:
                $string = 'Menunggu Pesanan';
                break;
            case 1:
                $string = 'Diterima';
                break;
            case 2:
                $string = 'Diambil';
                break;
            default:
                $string = 'Ditolak';
                break;
        }

        return $string;
    }

    /**
     * @param $status
     *
     * @return string
     */
    public static function getStatusPembayaran($status)
    {
        $string = '';
        switch ($status) {
            case 0:
                $string = 'Menunggu Pembayaran';
                break;
            case 1:
                $string = 'Pembayaran Diterima';
                break;
            default:
                $string = 'Pembayaran Ditolak';
                break;
        }

        return $string;
    }

    /**
     * @param $status
     *
     * @return string
     */
    public static function getStatusPembayaranAdmin($status)
    {
        $string = '';
        switch ($status) {
            case 1:
                $string = 'Pembayaran Diterima';
                break;
            default:
                $string = 'Menunggu Pembayaran';
                break;
        }

        return $string;
    }
}
