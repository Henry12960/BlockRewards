<?php

namespace HenryDM\BlockRewards\Events;

use HenryDM\BlockRewards\Main;
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
        $name = $player->getName();
        $bbaddamount = $this->getMain()->cfg->get("block-place-add-money-amount");
        $bbrmamount = $this->getMain()->cfg->get("block-place-reduce-money-amount");
        $itemid = $this->getMain()->cfg->get("block-place-add-item-id");
        $itemamount = $this->getMain()->cfg->get("block-place-add-item-amount");
        $command = str_replace(["{player}", "{line}"], [$name, "\n"], $this->getMain()->cfg->get("block-place-command-trigger"));
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
                            libEco::reduceMoney($player, $bbrmamount, static function(bool $success) : void {
                                if($success){
                                    //TODO
                                } else{
                                    //TODO
                                }
                            });
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
                            $event->getPlayer()->getInventory()->addItem(ItemFactory::getInstance()->get($itemid, 0, $itemamount));
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
                            $this->main->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender($this->main->getServer(), $this->main->getServer()->getLanguage()), $command);
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
                if(in_array($worldName, $this->getMain()->cfg->get("block-place-remove-xp-worlds", []))) {
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