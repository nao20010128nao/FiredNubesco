<?php

namespace nao20010128nao;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Server;

//穴掘り法で生成
class MazeGen1
{
	public __construct(){
		
	}
	public function generate($width,$height){
		//メモリ上の領域を確保
		$result=array();
		for($x=0;$x<$width;$x++){
			for($y=0;$y<$height;$y++){
				$result[$x]=array();
				$result[$x][$y]=false;
			}
		}
		$startX=mt_rand(0,$width/2-1)*2;//偶数にする
		$startZ=mt_rand(0,$height/2-1)*2;//偶数にする
		$nowX=$startX;
		$nowY=$startY;
		$stopped=0;//永遠ループ防止
		while(true){
			$dir=mt_rand(0,3);//上下左右だけでいい
			$tmpX=$nowX;
			$tmpY=$nowY;
			switch($dir){
			case 0://上
				$tmpY++;
				break;
			case 1://右
				$tmpX++;
				break;
			case 2://下
				$tmpY--;
				break;
			case 3://左
				$tmpX--;
				break;
			}
			if(!isset($result[$tmpX])){
				continue;
			}
			if(!isset($result[$tmpX][$tmpY])){
				continue;
			}
			if($result[$tmpX][$tmpY]){
				//既に道
				$stopped++;
				if($stopped>10){
					break;
				}else{
					continue;
				}
			}else{
				//壁
				$stopped=0;
				$result[$tmpX][$tmpY]=true;
				$nowX=$tmpX;
				$nowY=$tmpY;
			}
		}
		return $result;
	}
}