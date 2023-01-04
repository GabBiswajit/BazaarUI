<?php

namespace Biswajit;

use onebone\economyapi\EconomyAPI;

use jojoe77777\FormAPI\SimpleForm;

use jojoe77777\FormAPI\CustomForm;

use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

use pocketmine\scheduler\ClosureTask;

use pocketmine\Server;

class Bazaar extends PluginBase implements Listener {

  

  public function onEnable() : void {

    

        $this->getLogger()->info("BazaarUI By Biswajit Is Now Enabled ✅");

        

  }

  

  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        switch($command->getName()){

            case "bazaar":

              if($sender->hasPermission("bazaar.cmd")){

                $this->bazaar($sender);

              } else {

                $sender->sendMessage("You Don't Have Permission To Use This Command");

              }

        }

        return true;

  }

  

  public function bazaar(Player $player) {

    $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){

      if($data === null){

				return true;			}

      switch($data){

        case 0:

            $this->sell($player);

            break;

        

        case 1:

            $this->getServer()->dispatchCommand($player, "shop");

            break;

            

         case 2:

             $this->getServer()->dispatchCommand($player, "ah");

             break;

      }

    });

    $form->setTitle("§l§cBAZAAR");

    $form->setContent("§r§9Select The Next Menu For Open:");

    $form->addButton("§l§bSELL MENU\n§r§l§d» §r§8Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/4106/4106426.png");

    $form->addButton("§l§bSHOP MENU\n§r§l§d» §r§8Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/273/273177.png");

    $form->addButton("§l§bAUCTION HOUSE\n§r§l§d» §r§8Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/345/345629.png");

    $form->addButton("§cEXIT", 0, "textures/blocks/barrier");

    $form->sendtoPlayer($player);

    return $form;

  }

  

 public function sell(Player $player) {

    $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){

      if($data === null){

				return true;

			}

      switch($data){

        case 0:

            $this->getServer()->dispatchCommand($player, "sell hand");

            break;

            

        case 1:

            $this->getServer()->dispatchCommand($player, "sell ores");

            break;

            

        case 2:

            $this->getServer()->dispatchCommand($player, "sell inv");

            break;

            

        case 3:

            $this->bazaar($player);

            break;

        }

    });

    $form->setTitle("§l§cSELL");

    $form->setContent("§r§9Select The Method For Sell Items:");

    $form->addButton("§l§bSELL HAND\n§r§l§d» §r§8Tap To Sell", 1, "https://cdn-icons-png.flaticon.com/512/994/994305.png");

    $form->addButton("§l§bSELL ORES\n§r§l§d» §r§8Tap To Sell", 1, "https://cdn-icons-png.flaticon.com/512/994/994305.png");

    $form->addButton("§l§bSELL INVENTORY\n§r§l§d» §r§8Tap To Sell", 1, "https://cdn-icons-png.flaticon.com/512/994/994305.png");

    $form->addButton("§cBACK", 0, "textures/ui/icon_import");

        $form->sendtoPlayer($player);

        return $form;

    }

}
