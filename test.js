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