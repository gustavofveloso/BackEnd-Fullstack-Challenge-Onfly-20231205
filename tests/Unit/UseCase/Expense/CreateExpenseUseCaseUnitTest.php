<?php

namespace Tests\Unit\UseCase\Expense;

use Core\Domain\Entity\Expense;
use Core\Domain\Repository\ExpenseRepositoryInterface;
use Core\UseCase\DTO\Expense\ExpenseCreateInputDto;
use Core\UseCase\DTO\Expense\ExpenseCreateOutputDto;
use Core\UseCase\Expense\CreateExpenseUseCase;
use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;

class CreateExpenseUseCaseUnitTest extends TestCase
{
    private $mockRepo;
    private $mockEntity;
    private $mockInputDto;
    private $spy;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateNewExpense()
    {
        $id = 1;
        $user_id = 1;
        $description = 'Passagem de avião para o Chile';
        $date = '2024-01-15';
        $value = 299.99;

        $this->mockEntity = Mockery::mock(Expense::class,[
            $id,
            $user_id,
            $description,
            $date,
            $value
        ]);

        $this->mockRepo = Mockery::mock(stdClass::class, ExpenseRepositoryInterface::class);
        $this->mockRepo->shouldReceive('insert')->andReturn($this->mockEntity);
        
        $this->mockInputDto = Mockery::mock(ExpenseCreateInputDto::class, [
            $user_id,
            $description,
            $date,
            $value
        ]);


        $useCase = new CreateExpenseUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ExpenseCreateOutputDto::class, $responseUseCase);
        $this->assertEquals($description, $responseUseCase->description);

        /**
        * Spies
        */

        $this->spy = Mockery::spy(stdClass::class, ExpenseRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);

        $useCase = new CreateExpenseUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        
        $this->spy->shouldHaveReceived('insert');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}