<?php

namespace HenryDM\BlockRewards\Events;

use HenryDM\BlockRewards\Main;
use pocketmine\event\Listener;

use pocketmine\item\ItemFactory;
use davidglitch04\libEco\libEco;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\command\Command;

class BlockBreak implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event) {
        
# ==========================================        
        $player = $event->getPlayer();
        $bbaddamount = $this->getMain()->cfg->get("block-break-add-money-amount");
        $bbrmamount = $this->getMain()->cfg->get("block-break-reduce-money-amount");
        $itemid = $this->getMain()->cfg->get("block-break-add-item-id");
        $itemamount = $this->getMain()->cfg->get("block-break-add-item-amount");
        $command = str_replace(["{player}", "{line}"], [$name, "\n"], $this->getMain()->cfg->get("block-break-command-trigger"));
        $block = $event->getBlock()->getName();
        $name = $block;
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ==========================================

        if($this->getMain()->cfg->get("block-break-reward") === true) {
            if($this->getMain()->cfg->get("block-break-add-money") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-add-money-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->MoneyAddChance()) {
                            libEco::addMoney($player, $bbaddamount);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-break-reward") === true) {
            if($this->getMain()->cfg->get("block-break-reduce-money") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-reduce-money-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->MoneyReduceChance()) {
                            libEco::ReduceMoney($player, $bbrmamount);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-break-reward") === true) {
            if($this->getMain()->cfg->get("block-break-add-item") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-add-item-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->AddItemChance()) {
                            $event->getPlayer()->getInventory()->addItem(ItemFactory::getInstance()->get($itemid, 0, $itemamount));
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-break-rewards") === true) {
            if($this->getMain()->cfg->get("block-break-command") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-command-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->CommandChance()) {
                            $this->main->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), $command);
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-break-rewards") === true) {
            if($this->getMain()->cfg->get("block-break-add-xp") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-add-xp-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->AddXpChance()) {
                            $player->getXpManager()->addXpLevels($this->getMain()->cfg->get("block-break-add-xp-value"));
                        }
                    }
                }
            }
        }

        if($this->getMain()->cfg->get("block-break-remove-xp") === true) {
            if($this->getMain()->cfg->get("block-break-remove-xp") === true) {
                if(in_array($worldName, $this->getMain()->cfg->get("block-break-remove-xp-worlds", []))) {
                    if(in_array($name, $this->getMain()->cfg->getNested("blocks", []))) {
                        if($this->getMain()->RemoveXpChance()) {
                            $player->getXpManager()->subtractXpLevels($this->getMain()->cfg->get("block-break-remove-xp-value"));
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