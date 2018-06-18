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