<?php
class Account
{
    private int $accountNumber;
    private float $balance;

    public function __construct( int $accountNumber, float, $balance )
    {
        $this->accountNumer = $accountNumber;
        $this->balance = $balance;
    }

    public function lockForTransaction(): bool
    {

    }

    public function getBalance(): float
    {

    }

    public function setBalance( float $amount): bool
    {

    }
}

class Card
{
    private string $cardNumber;
    private int $pin;
    private Account $account;

    public function validateCard(): bool
    {
        return true;
    }

    public function getAccount(): Account
    {
        if ( $this->validCard() ) {
            if ( $this->account instanceof Account ) {
                return this->account;
            }
            [ $accountNumber, $balance ] = $this->findAccountDetailsByCard($this);
            $this->account = new Account( $accountNumber, $balance);
        } 
        throw new Exception( 'Invalid Card' );
    }
}

class ATM
{
    private Card $card;

    public function __construct( Card $card )
    {
        $this->card = $card;
    }
    

    public function withdraw( float $amount )
    {
        if ( 
            $this->card !== null
            && ($account = $this->card->getAccount())->lockForTransaction()
            && ( $currentAmount = $account->getBalance() ) >= $amount  
        ) {
            $account->setBalance( $currentAmount - $amount );
        }
    }
}
