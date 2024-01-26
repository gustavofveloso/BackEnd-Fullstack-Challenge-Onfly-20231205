<?php

namespace Tests\Unity\Domain\Entity;

use Core\Domain\Entity\Expense;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Throwable;

class ExpenseUnitTest extends TestCase 
{
    public function testAttributes()
    {
        $expense = new Expense(
            id: 1,
            user_id: 1,
            description: 'Passagem de avião para o Chile',
            date: '2024-01-15',
            value: 299.99
        );

        $this->assertNotEmpty($expense->createdAt());
        $this->assertEquals(1, $expense->user_id);
        $this->assertEquals('Passagem de avião para o Chile', $expense->description);
        $this->assertEquals('2024-01-15', $expense->date);
        $this->assertEquals(299.99, $expense->value);
    }

    public function testUpdate()
    {
        $expense = new Expense(
            id: 1,
            user_id: 1,
            description: 'Passagem de avião para o Chile',
            date: '2024-01-15',
            value: 299.99,
            createdAt: '2024-01-01 12:12:12',
        );

        $expense->update(
            description: 'Passagem de avião para o Peru',
            date: '2024-01-16',
            value: 399.99,
        );

        $this->assertEquals('Passagem de avião para o Peru', $expense->description);
        $this->assertEquals('2024-01-16', $expense->date);
        $this->assertEquals(399.99, $expense->value);
    }

    public function testUpdateWithoutSomeFields()
    {
        $expense = new Expense(
            id: 1,
            user_id: 1,
            description: 'Passagem de avião para o Chile',
            date: '2024-01-15',
            value: 299.99
        );

        $expense->updateWithoutSomeFields(
            description: 'Passagem de avião para o Peru',
        );

        $this->assertEquals('Passagem de avião para o Peru', $expense->description);
        $this->assertEquals('2024-01-15', $expense->date);
        $this->assertEquals(299.99, $expense->value);
    }

    public function testValidateExceptionDescription()
    {
        try {
            new Expense(
                id: 1,
                user_id: 1,
                description: random_bytes(999999),
                date: '2024-01-15',
                value: 299.99
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testValidateExceptionDate()
    {
        try {
            new Expense(
                id: 1,
                user_id: 1,
                description: 'Passagem de avião para o Chile',
                date: '2025-01-15',
                value: 299.99
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testValidateExceptionValue()
    {
        try {
            new Expense(
                id: 1,
                user_id: 1,
                description: 'Passagem de avião para o Chile',
                date: '2024-01-15',
                value: -299.99
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}