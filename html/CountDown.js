var CountDown = new Class({
   
    options:{
        limit:60,
        onComplete:function() {}
    },
   
    initialize:function(element,options){
        this.setOptions(options);
        this.element = element;
        this.limit = (this.options.limit * 1000);
        this.time = this.limit;
        this.cd = null;
        this.M = 0;
        this.S = 0;
        this.setter(this.limit);
        this.element.set('text', this.M+":"+this.S);
    },
   
    start:function(){
        this.cd=this.timer.periodical(1000,this);
    },
   
    pause:function(){
        $clear(this.cd);
    },
   
    reset:function(){
        $clear(this.cd);
        this.time = this.limit;
        this.setter(this.limit);
        this.element.set('text', this.M+":"+this.S);
    },
   
    setter:function(T){
        M = Math.floor(T/(60*1000));
        T = T-(M*60*1000);
        S = Math.floor(T/1000);
       
        if(S <10) S = "0"+S;
        if(M <10) M = "0"+M;
       
        this.S = S;
        this.M = M;
    },
   
    timer:function(){
       
        this.time = this.time - 1000;
        T = this.time;
       
        this.setter(T);
       
        this.element.set('text', this.M+":"+this.S);
       
        if(this.time==0){
            $clear(this.cd);
            this.fireEvent('complete');
        }
    }
    
});

CountDown.implement(new Options);
CountDown.implement(new Events);