# 代理模式

## js 代理模式基本概念闡述
    var xiaoming = {
        sendFlower: function( target){
            var flower = new Flower();
            target.receiveFlower( flower );
        }
    };
    var B = {
        receiveFlower: function( flower ){
            A.listenGoodMood(function(){ // 监听A 的好心情
                A.receiveFlower( flower );
            });
        }
    };
    var A = {
        receiveFlower: function( flower ){
            console.log( '收到花 ' + flower );
        },
        listenGoodMood: function( fn ){
            setTimeout(function(){ // 假设10 秒之后A 的心情变好
                fn();
            }, 1000 );
        }
    };
    xiaoming.sendFlower( B );

## es6 class
    class Flower{
        constructor(){}
    }

    class Xiaoming{
        constructor(){}
        sendFlower(target){
            let flower = new Flower()
            target.receiveFlower(flower);
        }
    }

    class A{
        constructor(){}
        listenGoodMood(fn){
            setTimeout(()=>{
                fn()
            },1000)
        }
        receiveFlower(flower){
            console.log('I received flower')
        }
    }

    class B{
        constructor(){}
        receiveFlower(flower){
            let a = new A()
            a.listenGoodMood(()=>{
                a.receiveFlower(flower)
            })
        }
    }

    let b = new B()
    let xiaoming = new Xiaoming()
    xiaoming.sendFlower(b)

## php class
    <?php
    interface shop{
        public function buy($title);
    }

    class CDshop implements shop{
        public function buy($title){
            echo "This is your cd $title".PHP_EOL;
        }
    }

    class proxyShop implements shop{
        public function buy($title){
            $this->go();
            $CDshop = new CDshop();
            $CDshop->buy($title);
        }
        private function go(){
            echo "go to hongkon".PHP_EOL;
        }
    }

    $CDbyYourself = new CDshop();
    $CDbyYourself -> buy("see you again".PHP_EOL);

    $CDbyProxy = new proxyShop();
    $CDbyProxy -> buy('wanna fly'.PHP_EOL);
    ?>