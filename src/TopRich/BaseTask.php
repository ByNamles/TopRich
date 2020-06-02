<?php

namespace TopRich;

use pocketmine\{Player, Server};
use pocketmine\scheduler\Task;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\level\Position;
use pocketmine\level\particle\FloatingTextParticle;

class BaseTask extends Task{
	
	private $main, $p;
	
	public function __construct(Base $main, Player $p){
		$this->main = $main;
		$this->p = $p;
	}
	
	public function onRun(int $currentTick){
		$x = 26;
		$y = 105.8437;
		$z = -44;
		$text = $this->main->getTitle()."\n".$this->main->getTopTenList();
		$particle = new FloatingTextParticle(new Vector3($x, $y, $z), $text);
		$this->p->getLevel()->addParticle($particle);
		
	}
	
}