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

namespace lordz\questPe\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use lordz\questPe\Main;
use pocketmine\utils\TextFormat;

/**
 * Class questCommand
 * @package lordz/questPe/Command
 */
class questCommand extends Command implements PluginIdentifiableCommand {

    /** @var Main $plugin */
    protected $plugin;

    /**
     * Quest constructor.
     * @param Main $plugin
     */
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        parent::__construct("quest", "Quest commands", \null, ["quest"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool|mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$sender instanceof Player){
            $sender->sendMessage("§cUse in game");
            return false;
        }
        $this->plugin->questForm($sender);
        return true;
    }

    public function getPlugin(): Main
    {
        return $this->plugin;
    }

}