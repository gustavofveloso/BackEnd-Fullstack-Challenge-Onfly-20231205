<?php

namespace Core\Domain\Entity;

use Carbon\Carbon;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use DateTime;

class Expense
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $id,
        protected int $user_id,
        protected string $description,
        protected string $date,
        protected float $value,
        protected DateTime|string $createdAt = '',
    ) {
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
        $this->validate();
    }

    public function update(string $description, string $date, float $value) 
    {
        $this->description = $description;
        $this->date = $date;
        $this->value = $value;
        $this->validate();
    }

    public function updateWithoutSomeFields(string $description = null, string $date = null, float $value = null) 
    {
        $this->description = $description ?? $this->description;
        $this->date = $date ?? $this->date;
        $this->value = $value ?? $this->value;
        $this->validate();
    }

    private function validate()
    {
        DomainValidation::strCanNullAndMaxLength($this->description);
        DomainValidation::strMinLength($this->description);

        $inputDate = Carbon::parse($this->date);
        $today = Carbon::now();

        if($inputDate->greaterThan($today))
        {
            throw new EntityValidationException("A future date is not accepted");
        }

        if($this->value < 0.0) {
            throw new EntityValidationException("The value cannot be negative");
        }
    }
}