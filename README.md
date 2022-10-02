## 🎁 • Block Rewards

| Version | Status | Date | 
| --- | --- | --- |
| 1.0.0 | stable-dev | 01/10/2022 |

---

## 📫 • General:

 - Plugin Introduction: 

   > This is a never seen before huge plugin, it adds options to add rewards to players in ```place``` or ```break``` blocks, your option can remove or add the odds!
 
 - Plugin Features:

   > This plugin is subdivided into features by category! All categories:
   > **[General](https://github.com/Henry12960/BlockRewards/new/main?readme=1#--features)**, 
   > **[Chances](https://github.com/Henry12960/BlockRewards/new/main?readme=1#--features)**,
   > **[Block Break](https://github.com/Henry12960/BlockRewards/new/main?readme=1#--features)**,
   > **[Block Place](https://github.com/Henry12960/BlockRewards/new/main?readme=1#--features)**.

 - Suggestions:

   > Don't add higher chances to get rewards, players can make a big farm out of it! **Reminder**, the chance is per block!

   > It has already been confirmed that ```EconomyAPI``` causes server lag, I recommend you use [BedrockEconomy](https://poggit.pmmp.io/p/BedrockEconomy/) in any way you can use the 2 options.

---
## 👷‍♂️ • Todo

   > If you want to add an alert to the player when lose money or an alert to the console if have any errors, use this api in the plugin:

```php

libEco::reduceMoney($player, $amount, static function(bool $success) : void {
	if($success){
		//IF SUCESS CODE
	} else{
		//IF FAIL CODE
	}
});
```
> For more, view: [LibEco](https://github.com/David-pm-pl/libEco)

---

## 🔰 • Features

 - General Category:
  
   > ➜ In this category you can setup Block ```Place``` and ```Break``` rewards and add block ```list``` that you want to give as reward!

 - Chances:
   
   > ➜ In this category you can config all events chances.

 - Block Break:

   > ➜ In this category you can configure all block ```break``` addons and enable or disable the same!

 - Block Place:

   > ➜ In this category you can configure all block ```place``` addons and enable or disable the same!
   
 - Features List: 
 
```
     • Can add money to break or place blocks!
     • Can remove money to break or place blocks!
     • Can add item to player on break or place blocks!
     • Can add commands!
     • Can add & remove player xp level!
     • Can configure per world features!
     • Can add chances to active features!
```     
    
---

## 📜 • License

```
   Copyright 2022 HenryDM

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

```
