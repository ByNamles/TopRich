<?php

namespace TopRich;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\{Player, Server};
use pocketmine\command\{CommandSender as Cs, Command as Cmd};
use onebone\economyapi\EconomyAPI;
use pocketmine\entity\Entity;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\event\player\PlayerJoinEvent;

class Base extends PluginBase implements Listener{
	


	  public static $default = ["Null" => 1];
	
	  public function onEnable(){
	  	$this->getLogger()->info("Aktif.");
	  	$this->economy = EconomyAPI::getInstance();
	  	$this->getServer()->getPluginManager()->registerEvents($this, $this);
		  $this->getScheduler()->scheduleDelayedTask(new BaseTask($this, $player), 1);
	  }
	
	public function onJoin(PlayerJoinEvent $e){
		$player = $e->getPlayer();
		  $this->getScheduler()->scheduleDelayedTask(new BaseTask($this, $player), 20*5);
	}
   
	  
	
	  public function getTopTenList() : string{
        $data = $this->economy->getAllMoney() ?? self::$default;
        arsort($data);
        $i = 1;
        $text = "";
        foreach(array_slice($data, 0, 10, false) as $key => $value){
            $text .= TextFormat::DARK_GRAY . "[" . TextFormat::AQUA . $i . TextFormat::DARK_GRAY . "] " . TextFormat::YELLOW . $key . TextFormat::DARK_RED . " => " . TextFormat::GOLD . $value . TextFormat::DARK_PURPLE . " Para" . TextFormat::EOL;
            $i++;
        }
        return $text;
    }

    public function getTitle() : string{
        return TextFormat::GRAY . "-==[ " . TextFormat::GREEN . "Sunucudaki en zengin 10 kişi" . TextFormat::GRAY . " ]==-";
    }
}
