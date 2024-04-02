<?php

interface Payroll {
    public function taxCalculation(float $baseSalary): float;
    public function getSalary(): float;
    public function getBaseSalary(): float;
}

class SouthRegion implements Payroll {
    protected int $totalHours;
    protected float $perHourCost;
    protected int $taxPercentage = 30;

    public function __construct(int $totalHours, float $perHourCost)
    {
        $this->totalHours = $totalHours;
        $this->perHourCost = $perHourCost;
    }

    public function taxCalculation(float $baseSalary): float
    {
        return ($baseSalary / 100) * $this->taxPercentage;
    }

    public function getBaseSalary(): float
    {
        return $this->totalHours * $this->perHourCost;
    }

    public function getSalary(): float
    {
        $baseSalary = $this->getBaseSalary();
        return $baseSalary - $this->taxCalculation($baseSalary);
    }
}

class FullTimeSouthRegionEmployee extends SouthRegion {
    public function __construct(float $perHourCost)
    {
        parent::__construct(240, $perHourCost);
    }
}

echo (new FullTimeSouthRegionEmployee(1500))->getSalary();
