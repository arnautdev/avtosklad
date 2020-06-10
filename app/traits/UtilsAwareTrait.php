<?php


namespace App\traits;


trait UtilsAwareTrait
{
    /**
     * @param null $iDate
     * @return \DateTime
     * @throws \Exception
     */
    public function sqlDate($iDate = null)
    {
        $iDate = strtotime($iDate);
        return new \DateTime(date('Y-m-d H:i:s', $iDate));
    }

}