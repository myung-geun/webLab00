"use strict";

var numberOfBlocks = 9;
var targetBlocks = [];
var trapBlock;
var targetTimer;
var trapTimer;
var instantTimer;


document.observe('dom:loaded', function(){
	$("start").onclick = function(){
		//clearInterval(timer);
		$("state").innerHTML = "Stop";
   		$("score").innerHTML = "0";
   		instantTimer = setInterval(startGame, 3000);
	}
	$("stop").onclick = stopGame;
});

function startGame(){
	targetBlocks=[];
	startToCatch();
}

function stopGame(){
	$("state").innerHTML = "Stop";
	targetBlocks=[];
	trapBlock="";
	clearInterval(instantTimer);
	clearInterval(targetTimer);
	clearInterval(trapTimer);
	var block = $$(".block");
	console.log(targetBlocks+"////"+trapBlock);
	for (var j = 0; j < block.length; j++) {
		block[j].removeClassName("target");
		block[j].removeClassName("trap");
	}
}

function startToCatch(){
	clearInterval(instantTimer);
	$("state").innerHTML = "Catch";
	var i=0;
	var block = $$(".block");
	var point=0;
	var check;

	targetTimer=setInterval(function(){
			if(i==5){
				alert(i);
				console.log(i);
				clearInterval(targetTimer);
				clearInterval(trapTimer);
			}
			else{
				if(i==0){
					targetBlocks[i]=Math.floor(Math.random() * 9);
					block[targetBlocks[i]].addClassName("target");	
					i++;
				}
				else{
					var target = Math.floor(Math.random() * 9);
					var exist=false;
					for(var j=0;j<targetBlocks.length;j++){
						if(target==targetBlocks[j]||target==trapBlock){
							exist=true;
						}
					}
					if(!exist){
						targetBlocks[i]=target;
						block[targetBlocks[i]].addClassName("target");
						i++;
					}
				}
		}
	},1000);
	trapTimer=setInterval(function(){
		var insert=true;
		while(insert){
			trapBlock = Math.floor(Math.random() * 9);
			//(trapBlock!=targetBlocks[0])&&(trapBlock!=targetBlocks[1])&&(trapBlock!=targetBlocks[2])
			var exist=false;
			for(var i =0;i<targetBlocks.length;i++){
				if(trapBlock==targetBlocks[i]){
					exist=true;
				}
			}
			if(!exist){
				block[trapBlock].addClassName("trap");
				insert=false;
			}
			if(!insert){
				break;
			}
		}
		setTimeout(function(){
			block[trapBlock].removeClassName("trap");
		},2000)
	},3000);

	for (var j = 0; j < block.length; j++) {
		//block[j].removeClassName("target");
		block[j].observe("click", function(){
			var sc = $("score").innerHTML;
			if(!this.hasClassName("target") && !this.hasClassName("trap")){
				if(Number(sc) >= 10){
					sc = Number(sc) - 10;
				}
				this.addClassName("wrong");
				var that = this;
				setTimeout(function(){
					that.removeClassName("wrong");
				}, 100);
			}
			else if(this.hasClassName("target")){
				sc = Number(sc) + 20;
				this.removeClassName("target");
				i--;
				for(var k=0;k<targetBlocks.length;k++){
					if(this.readAttribute('data-index')==targetBlocks[k]){
						targetBlocks.splice(k, 1);
					}
				}
			}
			else if(this.hasClassName("trap")){
				sc = Number(sc) - 30;
				this.removeClassName("trap");
			}

			$("score").innerHTML = sc;
		});
	}
}