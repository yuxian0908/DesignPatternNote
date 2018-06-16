<?php
    //abstract of strategy
    interface Strategy{
        public function speak();
    }

    //woman strategy
    class ConcreteStrategyA implements Strategy{
        public function speak(){
            echo 'i am woman'.PHP_EOL;
        }
    }

    //man strategy
    class ConcreteStrategyB implements Strategy{
        public function speak(){
            echo 'i am man'.PHP_EOL;
        }

    }

    //unknow strategy
    class ConcreteStrategyC implements Strategy{
        public function speak(){
            echo 'i dont know who i am'.PHP_EOL;
        }
    }

    //environment
    class whoIam{
        protected $strategy;

        public function __construct(Strategy $strategy){
            $this->strategy = $strategy;
        }

        public function define(){
            $this->strategy->speak($this);
        }
    }

    $female = new whoIam(new ConcreteStrategyA);
    $female->define();

    $male = new whoIam(new ConcreteStrategyB);
    $male->define();
    
    $unknow = new whoIam(new ConcreteStrategyC);
    $unknow->define();