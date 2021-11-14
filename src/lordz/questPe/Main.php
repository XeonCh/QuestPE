<?php

/*
 * QuestPE, the massive quest plugin with many features for PocketMine-MP
 * Copyright (C) 2020-2021  Lordzz/XeonCh
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace lordz\questPe;

use pocketmine\Player;
use pocketmine\Server;

use lordz\questPe\Command\questCommand;
use onebone\economyapi\EconomyAPI;
 
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\block\{Wood, Wood2, WoodenStairs, WoodenFence, WoodenSlab, DiamondOre, Diamond, Iron, IronOre, Gold, GoldOre, Emerald, EmeraldOre, Stone, Cobblestone, Redstone, RedstoneOre, Coal, CoalOre, Lapis, LapisOre, Planks, Obsidian};

use pocketmine\event\player\PlayerJoinEvent;

use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\CustomForm;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\inventory\CraftItemEvent;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
    {
        
    /** @var Command[] $commands */
    public $commands = [];
    
    /** @var string $prefix */
    public $prefix = "§bQuestPE§6 »§r ";
    
    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->saveResource("message.yml");
        $this->getMsg = new Config($this->getDataFolder() . "message.yml", Config::YAML, array());
        $this->running = new Config($this->getDataFolder() . "running.yml", Config::YAML, array());
        $this->check = new Config($this->getDataFolder() . "check.yml", Config::YAML, array());
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("quest", $this->commands[] = new questCommand($this));
        $this->getLogger()->info("§1Succes load depend");
        $this->getLogger()->info("\n".
                "--------------------------------\n".
                "Lordzz » QuestPE\n".
                "Authors: Lordz/XeonCh\n".
                "Version: ".$this->getDescription()->getVersion()."\n".
                "Statuss: Enable...\n".
                "--------------------------------");
    }
    
    public function onLoad()
    {
      $this->getLogger()->info("§1Check the dependencies of this plugin");
    }
    
    public function onDisable()
    {
        $this->getLogger()->info("§cSomething is wrong");
    }
    
    public function onJoin(PlayerJoinEvent $event)
    {
      $player = $event->getPlayer();
      if($player->hasPlayedBefore() == false){
        $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm {$player->getName()} quest.one");
        $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("first-joinmsg")));
      }
    }
    
    public function checkQuest($player)
    {
        return $this->check->get($player);
    }
    
    public function questForm($player)
    {
              $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
                if($data === null){
                  return true;
                } 
                 switch($data){
                     case 0:
                       if($player->hasPermission("quest.one")){
                         $p = strtolower($player->getName());
                         $checkk = $this->checkQuest($p);
                         $this->check->set($p, "1");
                         $this->check->save();
                         $player->sendMessage($this->prefix . "You quest is break 64x log");
                         $this->running->set($p, "0");
                         $this->running->save();
                       } else {
                         $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("done-quest")));
                       }
                     break;
                     case 1:
                       if($player->hasPermission("quest.two")){
                         $p = strtolower($player->getName());
                         $checkk = $this->checkQuest($p);
                         $this->check->set($p, "2");
                         $this->check->save();
                         $player->sendMessage($this->prefix . "You quest is place 128x planks");
                         $this->running->set($p, "0");
                         $this->running->save();
                       } else {
                         $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("done-quest")));
                       }
                     break;
                     case 2:
                       if($player->hasPermission("quest.three")){
                         $p = strtolower($player->getName());
                         $checkk = $this->checkQuest($p);
                         $this->check->set($p, "3");
                         $this->check->save();
                         $player->sendMessage($this->prefix . "You quest is break 128x block mining");
                         $this->running->set($p, "0");
                         $this->running->save();
                       } else {
                         $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("done-quest")));
                       }
                     break;
                     case 3:
                       if($player->hasPermission("quest.four")){
                         $p = strtolower($player->getName());
                         $checkk = $this->checkQuest($p);
                         $this->check->set($p, "4");
                         $this->check->save();
                         $player->sendMessage($this->prefix . "You quest is break 16x obsidian");
                         $this->running->set($p, "0");
                         $this->running->save();
                       } else {
                         $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("done-quest")));
                       }
                     break;
                     case 4:
                       if($player->hasPermission("quest.five")){
                         $p = strtolower($player->getName());
                         $checkk = $this->checkQuest($p);
                         $this->check->set($p, "5");
                         $this->check->save();
                         $player->sendMessage($this->prefix . "You quest is craft 1x beacon");
                         $this->running->set($p, "0");
                         $this->running->save();
                       } else {
                         $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("done-quest")));
                       }
                     break;
                }
            });
            $form->setTitle($this->getConfig()->get("title"));
            if($player->hasPermission("quest.one")){
                $form->addButton("§6Getting Wood§7\nRunning quest");
            } else {
                $form->addButton("§cLocked\n§7Not open");
            }
            if($player->hasPermission("quest.two")){
                $form->addButton("§6Build House§7\nRunning quest");
            } else {
                $form->addButton("§cLocked\n§7Not open");
            }
            if($player->hasPermission("quest.three")){
                $form->addButton("§6Mining§7\nRunning quest");
            } else {
                $form->addButton("§cLocked\n§7Not open");
            }
            if($player->hasPermission("quest.four")){
                $form->addButton("§6Nether§7\nRunning quest");
            } else {
                $form->addButton("§cLocked\n§7Not open");
            }
            if($player->hasPermission("quest.five")){
                $form->addButton("§6Beacon§7\nRunning quest");
            } else {
                $form->addButton("§cLocked\n§7Not open");
            }
            
            $form->sendToPlayer($player);
            return $form;
    }
    
    public function onBreak(BlockBreakEvent $event)
    {
        if($event->isCancelled()){
            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $money1 = $this->getConfig()->get("quest1-price");
        $money3 = $this->getConfig()->get("quest3-price");
        $money4 = $this->getConfig()->get("quest4-price");
        $p = strtolower($player->getName());
        if($this->checkQuest($p) == 1){
          if($block instanceof Wood or $block instanceof Wood2){
            $this->running->set($p, $this->running->get($p) + 1);
            $this->running->save();
            $status = 64 - $this->running->get($p);
            $player->sendTip($this->prefix . "§fBreak log " . $status . "x");
            if($this->running->get($p) == 64){
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "unsetuperm {$player->getName()} quest.one");
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm {$player->getName()} quest.two");
              $player->sendTip("§aYou got §e{$money1}§a from the quest");
              $this->running->set($p, "0");
              $this->running->save();
              $this->check->set($p, "0");
              $this->check->save();
              EconomyAPI::getInstance()->addMoney($player, $money1);
              $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("succes-quest1")));
              $player->addTitle($this->translate($this->getMsg->get("title-newquest")));
            }
        }
    }elseif($this->checkQuest($p) == 3){
          if($block instanceof Diamond or $block instanceof DiamondOre or $block instanceof Iron or $block instanceof IronOre or $block instanceof Gold or $block instanceof GoldOre or $block instanceof Emerald or $block instanceof EmeraldOre or $block instanceof Stone or $block instanceof Cobblestone or $block instanceof Redstone or $block instanceof RedstoneOre or $block instanceof Coal or $block instanceof CoalOre or $block instanceof Lapis or $block instanceof LapisOre){
            $this->running->set($p, $this->running->get($p) + 1);
            $this->running->save();
            $status = 128 - $this->running->get($p);
            $player->sendTip($this->prefix . "§fMining " . $status . "x");
            if($this->running->get($p) == 128){
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "unsetuperm {$player->getName()} quest.three");
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm {$player->getName()} quest.four");
              $this->running->set($p, "0");
              $this->running->save();
              $this->check->set($p, "0");
              $this->check->save();
              EconomyAPI::getInstance()->addMoney($player, $money3);
              $player->sendTip("§aYou got §e{$money3}§a from the quest");
              $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("succes-quest3")));
              $player->addTitle($this->translate($this->getMsg->get("title-newquest")));
            }
        }
    }elseif($this->checkQuest($p) == 4){
          if($block instanceof Obsidian){
            $this->running->set($p, $this->running->get($p) + 1);
            $this->running->save();
            $status = 16 - $this->running->get($p);
            $player->sendTip($this->prefix . "§fBreak obsidian " . $status . "x");
            if($this->running->get($p) == 16){
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "unsetuperm {$player->getName()} quest.four");
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm {$player->getName()} quest.five");
              $this->running->set($p, "0");
              $this->running->save();
              $this->check->set($p, "0");
              $this->check->save();
              EconomyAPI::getInstance()->addMoney($player, $money4);
              $player->sendTip("§aYou got §e{$money4}§a from the quest");
              $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("succes-quest4")));
              $player->addTitle($this->translate($this->getMsg->get("title-newquest")));
            }
        }
    }
}
        
    public function onPlace(BlockPlaceEvent $event)
    {
        if($event->isCancelled()){
            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $money2 = $this->getConfig()->get("quest2-price");
        $p = strtolower($player->getName());
        if($this->checkQuest($p) == 2){
          if($block instanceof Planks or $block instanceof WoodenStairs or $block instanceof WoodenSlab or $block instanceof WoodenFence){
            $this->running->set($p, $this->running->get($p) + 1);
            $this->running->save();
            $status = 128 - $this->running->get($p);
            $player->sendTip($this->prefix . "§fBuild House " . $status . "x");
            if($this->running->get($p) == 128){
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "unsetuperm {$player->getName()} quest.two");
              $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm {$player->getName()} quest.three");
              $this->running->set($p, "0");
              $this->running->save();
              $this->check->set($p, "0");
              $this->check->save();
              EconomyAPI::getInstance()->addMoney($player, $money2);
              $player->sendTip("§aYou got §e{$money2}§a from the quest");
              $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("succes-quest2")));
              $player->addTitle($this->translate($this->getMsg->get("title-newquest")));
            }
        }
    }
}
   
    public function onCraft(CraftItemEvent $event)
    {
        if($event->isCancelled()){
            return;
        }
        $player = $event->getPlayer();
        $items = $event->getOutputs();
        $money5 = $this->getConfig()->get("quest5-price");
        $p = strtolower($player->getName());
        if($this->checkQuest($p) == 5){
            foreach($items as $item){
                if($item->getId() == 138){
                    $this->running->set($p, $this->running->get($p) + 1);
                    $this->running->save();
                    $status = 1 - $this->running->get($p);
                    $player->sendTip($this->prefix . "§fCraft beacon " . $status . "x");
                    if($this->running->get($p) == 1){
                    $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "unsetuperm {$player->getName()} quest.five");
                    $this->running->set($p, "0");
                    $this->running->save();
                    $this->check->set($p, "0");
                    $this->check->save();
                    EconomyAPI::getInstance()->addMoney($player, $money5);
                    $player->sendTip("§aYou got §e{$money5}§a from the quest");
                    $player->sendMessage($this->translate($this->prefix . $this->getMsg->get("succes-quest5")));
                    }
                }
            }
        }
    }
    
    public function translate($string){
        $msg = str_replace("&1",TF::DARK_BLUE,$string);
        $msg = str_replace("&2",TF::DARK_GREEN,$msg);
        $msg = str_replace("&3",TF::DARK_AQUA,$msg);
        $msg = str_replace("&4",TF::DARK_RED,$msg);
        $msg = str_replace("&5",TF::DARK_PURPLE,$msg);
        $msg = str_replace("&6",TF::GOLD,$msg);
        $msg = str_replace("&7",TF::GRAY,$msg);
        $msg = str_replace("&8",TF::DARK_GRAY,$msg);
        $msg = str_replace("&9",TF::BLUE,$msg);
        $msg = str_replace("&0",TF::BLACK,$msg);
        $msg = str_replace("&a",TF::GREEN,$msg);
        $msg = str_replace("&b",TF::AQUA,$msg);
        $msg = str_replace("&c",TF::RED,$msg);
        $msg = str_replace("&d",TF::LIGHT_PURPLE,$msg);
        $msg = str_replace("&e",TF::YELLOW,$msg);
        $msg = str_replace("&f",TF::WHITE,$msg);
        $msg = str_replace("&o",TF::ITALIC,$msg);
        $msg = str_replace("&l",TF::BOLD,$msg);
        $msg = str_replace("&r",TF::RESET,$msg);
        $msg = str_replace("{line}", "\n",$msg);
        return $msg;
    }
}