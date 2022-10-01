<?php

namespace HenryDM\BlockReward\Events;

use HenryDM\BlockReward\Main;
use pocketmine\event\Listener;

use pocketmine\item\ItemFactory;
use davidglitch04\libEco\libEco;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\command\Command;

class BlockPlace implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlace(BlockPlaceEvent $event) {
        
# ==========================================        
        $player = $event->getPlayer();
        $bbaddamount = $this->getMain()->cfg->get("place-add-money-amount");
        $bbrmamount = $this->getMain()->cfg->get("place-reduce-money-amount");
        $command = $this->getMain()->cfg->get("place-command-trigger");
        $block = $event->getBlock()->getName();
        $name = $block;
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ==========================================

        if($this->getMain()->cfg->get("block-place-reward") === true) {
            if($this->getMain()->cfg->get("block-place-add-money") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-add-money-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->MoneyAddChance()) {
                            libEco::addMoney($player, $bbaddamount);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-place-reward") === true) {
            if($this->getMain()->cfg->get("block-place-reduce-money") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-reduce-money-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->MoneyReduceChance()) {
                            libEco::ReduceMoney($player, $bbrmamount);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-place-reward") === true) {
            if($this->getMain()->cfg->get("block-place-add-item") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-add-item-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->AddItemChance()) {
                            $event->getPlayer()->getInventory()->addItem(ItemFactory::getInstance()->get($itemid));
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-place-rewards") === true) {
            if($this->getMain()->cfg->get("block-place-command") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-command-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->CommandChance()) {
                            $this->main->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), $command);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-place-rewards") === true) {
            if($this->getMain()->cfg->get("block-place-add-xp") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-add-xp-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->AddXpChance()) {
                            $player->getXpManager()->addXpLevels($this->getMain()->cfg->get("block-place-add-xp-value"));
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-place-remove-xp") === true) {
            if($this->getMain()->cfg->get("block-place-remove-xp") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-remove-xp", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->RemoveXpChance()) {
                            $player->getXpManager()->subtractXpLevels($this->getMain()->cfg->get("block-place-remove-xp-value"));
                        }
                    }
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}