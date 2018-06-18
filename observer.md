# 觀察者模式

## js網頁範例
    document.body.addEventListener( 'click', function(){
        alert(4);
    }, false );
    document.body.click();

## js 範例一(不指定事件名稱)
    // 定義發布者
    var salesOffices = {}; 
    salesOffices.clientList = []; 
    salesOffices.listen = function( fn ){ 
        this.clientList.push( fn ); 
    };
    salesOffices.trigger = function(){ 
        for( var i = 0, fn; fn = this.clientList[ i++ ]; ){
            fn.apply( this, arguments ); 
        }
    };

    // 訂閱事件
    salesOffices.listen( function( price, squareMeter ){ 
        console.log( 'price= ' + price );
        console.log( 'squareMeter= ' + squareMeter );
    });
    salesOffices.listen( function( price, squareMeter ){ 
        console.log( 'price= ' + price );
        console.log( 'squareMeter= ' + squareMeter );
    });

    // 發布事件
    salesOffices.trigger( 2000000, 88 );
    salesOffices.trigger( 3000000, 110 );

## js 範例二(指定事件名稱)
    // 定義發布者
    var salesOffices = {};
    salesOffices.clientList = {};
    salesOffices.listen = function( key, fn ){//增加事件名稱:key
        if ( !this.clientList[ key ] ){
            this.clientList[ key ] = [];
        }
        this.clientList[ key ].push( fn );
    };
    salesOffices.trigger = function(){
        var key = Array.prototype.shift.call( arguments ),
        fns = this.clientList[ key ];
        if ( !fns || fns.length === 0 ){//若沒有該事件名稱則返回false
            return false;
        }
        for( var i = 0, fn; fn = fns[ i++ ]; ){
            fn.apply( this, arguments );
        }
    };

    // 訂閱者
    salesOffices.listen( 'squareMeter88', function( price ){
        console.log( 'price= ' + price );
    });
    salesOffices.listen( 'squareMeter110', function( price ){
        console.log( 'price= ' + price ); 
    });

    // 發布事件
    salesOffices.trigger( 'squareMeter88', 2000000 ); 
    salesOffices.trigger( 'squareMeter110', 3000000 ); 

## js 範例三(將發布功能包成物件)
    // 將發布功能定義成物件
    var event = {
        clientList: [],
        listen: function( key, fn ){
            if ( !this.clientList[ key ] ){
                this.clientList[ key ] = [];
            }
            this.clientList[ key ].push( fn );
        },
        trigger: function(){
            var key = Array.prototype.shift.call( arguments ),
            fns = this.clientList[ key ];
            if ( !fns || fns.length === 0 ){
                return false;
            }
            for( var i = 0, fn; fn = fns[ i++ ]; ){
                fn.apply( this, arguments ); 
            }
        }
    };

    // 發布功能安裝
    var installEvent = function( obj ){
        for ( var i in event ){
            obj[ i ] = event[ i ];
        }
    };

    // 宣告發布者
    var salesOffices = {};
    installEvent( salesOffices );

    // 訂閱者
    salesOffices.listen( 'squareMeter88', function( price ){
        console.log( '价格= ' + price );
    });
    salesOffices.listen( 'squareMeter100', function( price ){
        console.log( '价格= ' + price );
    });

    // 發布事件
    salesOffices.trigger( 'squareMeter88', 2000000 );
    salesOffices.trigger( 'squareMeter100', 3000000 ); 

## php範例
    <?php
    // 定義主題
    abstract class Subject{
        //observers array
        private $observers = array();
        public function addObserver(Observer $observer){
            $this->observers[] = $observer;
            echo "add observer suc".PHP_EOL;
        }
        public function delObserver(Observer $observer){
            $key = array_search($observer,$this->observers); //判斷是否有觀察者
            if($observer===$this->observers[$key]) { //全等判斷
                unset($this->observers[$key]);
                echo 'delete observer suc'.PHP_EOL;
            } else{
                echo 'observer not exist'.PHP_EOL;
            }
        }
        public function notifyObservers(){
            foreach($this->observers as $observer){
                $observer->update();
            }
        }
    }

    class Server extends Subject{
        public function publish(){
            echo 'update'.PHP_EOL;
            $this->notifyObservers();
        }
    }

    // 定義觀察者
    Interface Observer{
        public function update();
    }

    class Wechat implements Observer{
        public function update(){
            echo 'wechat'.PHP_EOL;
        }
    }
    class Web implements Observer{
        public function update(){
            echo 'web'.PHP_EOL;
        }
    }
    class App implements Observer{
        public function update(){
            echo 'app'.PHP_EOL;
        }
    }

    //實例化主題
    $server = new Server ;
    //實例化觀察者
    $wechat = new Wechat ;
    $web = new Web ;
    $app = new App;

    // test publish
    $server->addObserver($wechat);
    $server->addObserver($web);
    $server->addObserver($app);
    $server->publish();

    // test delete observer
    $server->delObserver($wechat);
    $server->publish();

    // test delete observer which is not exist
    $server->delObserver(new Web);
    $server->publish();