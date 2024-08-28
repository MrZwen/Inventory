<?php 
namespace App\Services;
use App\Repositories\SettingRepository;


class SettingService
{
    protected $settingRepository;
    
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getLowStockThreshold()
    {
        return $this->settingRepository->get('low_stock_threshold')->value;
    }

    public function updateLowStockThreshold($value)
    {
        $update = $this->settingRepository->updateByKey('low_stock_threshold', $value);
    }
}

?>