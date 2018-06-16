# 策略模式

## js函數模式
    var strategies = {
        "S": function( salary ){
        return salary * 4;
        },
        "A": function( salary ){
        return salary * 3;
        },
        "B": function( salary ){
        return salary * 2;
        }
    };
    var calculateBonus = function( level, salary ){
        return strategies[ level ]( salary );
    };
    console.log( calculateBonus( 'S', 20000 ) ); // 输出：80000
    console.log( calculateBonus( 'A', 10000 ) ); // 输出：30000

## js class模式
    class strategyA{
        constructor(){}
        speak(){
            console.log("i am man")
        }
    }
    class strategyB{
        constructor(){}
        speak(){
            console.log("i am woman")
        }
    }
    class strategyC{
        constructor(){}
        speak(){
            console.log("i dont know who i am")
        }
    }

    class whoIam{
        constructor(req){
            let strategy = req
            this.define = ()=>{
                strategy.speak()
            }
        }
    }

    let male = new whoIam(new strategyA())
    male.define()
    let female = new whoIam(new strategyB())
    female.define()
    let unknow = new whoIam(new strategyC())
    unknow.define()


## php
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