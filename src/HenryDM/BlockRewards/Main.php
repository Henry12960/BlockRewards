<?php

namespace HenryDM\BlockRewards;

# =======================
#    Pocketmine Class
# =======================

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# =======================
#      Plugin Class
# =======================

use HenryDM\BlockRewards\Events\BlockBreak;
use HenryDM\BlockRewards\Events\BlockPlace;

class Main extends PluginBase implements Listener {  
    
    /*** @var Main|null */
    private static Main|null $instance;

    /*** @var Config */
    public Config $cfg;    

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig();

        $events = [
            BlockBreak::class,
            BlockPlace::class
        ];
        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public function getInstance() : Main {
        return self::$instance;
    }

    public function getMainConfig() : Config {
        return $this->cfg;
    }

    public function MoneyAddChance() {
        $bbaddpercentage = mt_rand(1, 100);
        $bbaddchance = $this->cfg->get("add-money-chance-value");
        if($bbaddpercentage <= $bbaddchance) {
            return true;
        } else{
            return false;
    	}
    }

    public function MoneyReduceChance() {
        $bbrmpercentage = mt_rand(1, 100);
        $bbrmchance = $this->cfg->get("reduce-money-chance-value");
        if($bbrmpercentage <= $bbrmchance) {
            return true;
        } else{
            return false;
    	}
    }

    public function AddItemChance() {
        $bbaipercentage = mt_rand(1, 100);
        $bbaichance = $this->cfg->get("add-item-chance-value");
        if($bbaipercentage <= $bbaichance) {
            return true;
        } else{
            return false;
    	}
    }

    public function CommandChance() {
        $bbcmdpercentage = mt_rand(1, 100);
        $bbcmdchance = $this->cfg->get("command-chance-value");
        if($bbcmdpercentage <= $bbcmdchance) {
            return true;
        } else {
            return false;
    	}
    }

    public function AddXpChance() {
        $bbaddxppercentage = mt_rand(1, 100);
        $bbaddxpchance = $this->cfg->get("add-xp-chance-value");
        if($bbaddxppercentage <= $bbaddxpchance) {
            return true;
        } else{
            return false;
    	}
    }

    public function RemoveXpChance() {
        $bbremovexppercentage = mt_rand(1, 100);
        $bbremovexpchance = $this->cfg->get("remove-xp-chance-value");
        if($bbremovexppercentage <= $bbremovexpchance) {
            return true;
        } else{
            return false;
    	}
    }
}