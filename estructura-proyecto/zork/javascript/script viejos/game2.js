var panel = $('#zork-area');

<script type="text/javascript">
    //Our main js code called by Jquery on doc ready
    $(document).ready(function () {
        //game variables    
        var message,                //screen message to display
        hits = 10,                  //hit points for the player
        lightLevel = 100,           //current light level
        currentRoom = 0,            //initial room  
        exitRoom = 31,              //final room of the dungeon
        IsGameOver = false;         //Maintain the state of the game
        IsOgreAlive = true,         //Stores the state of the Ogre - Alive/Dead
        IsDragonAlive = true;       //this is the gameover state

        //All the commands we use in the game
        var gameWords = new Array("HELP", "Find/earch", "N-orth", "S-outh", "W-est", "E-east','A-About");

        //All the rooms in the game
        var rooms = new Array("Dungeon Entrance", "Corridor of uncertainty", 'Ancient old cavern', "Great Cavern", "Underground River", "Stream", 'Dungeon Stream', "Dungeon Pool",
                              "Large Cavern", "Rough Tunnell", "Long Tunnell", "Dark Room", "Dark Room", "Cold Room", "Old Tunnel", "Cold Room",
                              "Old Cavern", "Short Corridor", "Short Corridor", "Grey Room", "Green Room", "Old Prison Cell", "Underground River",
                              "Large Cavern", "Rough Tunnell", "Long Tunnell", "Dark Room", "Dark Room", "Cold Room", "Old Tunnel", "Dragons Room");

        //Each exit relates to the index ie. Exits[0] SE which means rooms[0] the long path has two exits on the  South and East. If we look
        //down to the //Movement Code section you can see how we work out which rooms are connected to which
        var exits = new Array("E", "SWE", "WE", "SWE", "WE", "WE", "SWE", "WS",
                              "NSE", "SE", "WE", "NW", "SE", "W", "SNE", "NSW",
                              "NS", "NS", "SE", "WE", "NWE", "SWE", "WS", "N",
                              "N", "NWE", "NWE", "WE", "WE", "NW", "NE", "W");

        //All out game objects
        var GameObjects = new Array('', "Painting", "Knife", "Wand of Firebolts", "Goblet", "Wand of Wind", "Coins", "Helmet", "Candle", "Torch", "Iron Shield", "Armour", "Oil", "AXE", "ROPE", "BOAT", "AEROSOL", "CANDLE", "KEY");

        //Inventory array Contains all the things you can carry
        var inventory = new Array();
        inventory[0] = 2; //lets start our player off with a knife

        //location of game objects - these objects relate to a array index - so Object[1] the Painting is located
        //in rooms[2] the small garden - 999 indicates out of play 
        var objectLocations = [999, 1, 999, 3, 4, 5, 6, 7, 8, 10, 11, 15, 14, 12, 18, 19, 16, 17, 9]

        //This function detects if the browser if a mobile - you'll see when we call this we apply the 
        function isMobile() {
            return navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/iPhone|iPad|iPod/i)
                    || navigator.userAgent.match(/Opera Mini/i) || navigator.userAgent.match(/IEMobile/i);
        }

        //The next line checks for a mobile browser and if it find st it will hide the buttons or hide the text box
        if (isMobile()) {
            //hide the text box - we dont need that for a mobile browser as its hard to use mobile keyboard for lots of commands
            $("#Keyboard").hide();
        } else {
            //hide the buttons as we don't want that for the normal web experience
            $('#controllers').hide();

            //jquery command to force the textbox to take focus  
            $("#userInput").focus();
        }

        //javascript function to pickup the object in this room
        var pickup = function (roomIndex) {
            var itemIndex;
            if (objectLocations[roomIndex] > 0 && objectLocations[roomIndex] < 100) {
                itemIndex = objectLocations[roomIndex];
                inventory[inventory.length] = itemIndex;
                objectLocations[roomIndex] = 999;
                alert(objectLocations[roomIndex]);
            }
        }
        //This function  loops through the object location array and returns
        function getObjectForRoom(currentRoom) {
            var roomIndex = -1;
            for (var i = 0; i < objectLocations.length ; i++) {
                if (objectLocations[i] == currentRoom)
                    roomIndex = i;
            }
            return roomIndex
        }

        //This is a method/function that shows the game screen. If we look in deatil at this function we can see that 
        //it uses another function DisplayText to show each line of the screen.
        function DisplayGameScreen() {

            //clear the output div
            $display.empty();

            //Display the screen output text - note this does not include the buttons
            DisplayText("You are now in the :");
            DisplayText(rooms[currentRoom]);
            DisplayText("Exits: " + ShowAdjacentRooms(exits[currentRoom]) + "<br />");
            DisplayText('DB:' + currentRoom + 'Light:' + lightLevel + "Hits:" + hits);
            if (getObjectForRoom(currentRoom) != -1) {
                var index = getObjectForRoom(currentRoom);
                DisplayText("You can see " + GameObjects[index]);
            }

            //If there is something in our inventory then display it
            if (inventory.length > 0) {
                DisplayText("You are carrying: ");
                for (var i = 0; i < inventory.length ; i++) {
                    DisplayText("-" + GameObjects[inventory[i]]);
                }
            }

            if (message != null)
                DisplayText(message.toUpperCase());

            //Game over code
            if (IsDragonAlive) {
                $('#GameOverDiv').hide();
                $('#GameDiv').show();
            }
            else {
                $('#GameOverDiv').show();
                $('#GameDiv').hide();
            }
            message = "What?";
        }

        //Replaces the indexOf js function as i have found it doesn't always work for me!!!!!!!!
        function checkIndex(issFullArray, issToCheck) {
            for (i = 0; i < issFullArray.length; i++) {
                if (issFullArray[i] == issToCheck) {
                    return true;
                }
            }
            return false;
        }

        //Uses the text for a room to build a string that shows which rooms are next to the current room
        function ShowAdjacentRooms(e) {
            var newExits = "";
            if (e != null) {
                for (i = 0; i < e.length; i++) {
                    if (i === e.length - 1) {
                        newExits += e.substring(i, i + 1);
                    } else if (i === e.length - 2) {
                        newExits += e.substring(i, i + 1) + " & ";
                    } else {
                        newExits += e.substring(i, i + 1) + ", ";
                    }
                }
            }
            return newExits;
        }

        //Simple js function to display a line of text
        function DisplayText(text) {
            $display.html($display.html().toString() + text + "<br>");
        }

        //Each round we call this function to do all the main game processing 
        function ProcessGameRound(command) {

            //Remove any spaces from the command text
            trimCommand = $.trim(command);

            //Process command takes the players action
            ProcessCommand(command);

            //NOw that we have taken the players logic we need to activate the main game room logic
            if (currentRoom == 10 && OgreAlive) {
                //if you are fighting the ogre and you have the spells
                if (checkIndex(inventory, 3)) {
                    message += "\<br\>YOU attack the ogre with magic spells and kill him!";
                    OgreAlive = false;
                }
                else {
                    message += "\<br\>Ogre attacks you!";
                    hits--;
                }
            }

            //If you are in the final room and the dragon is still alive
            if (currentRoom == 31 && IsDragonAlive) {
                //if you are fighting the dragon and you have the oil, burning torch
                if (checkIndex(inventory, 5) && checkIndex(inventory, 9) && checkIndex(inventory, 12)) {
                    message += "\<br\>You attack the dragon with oil, burning torch and the wand of Wind - It creates and kill him!";
                    IsDragonAlive = false; //End Game           
                }
                else {
                    message += "\<br\>The dragon attacks you with firebreath and kills you!";
                    hits = 0;
                }
            }

            if (currentRoom == 25) {
                //if you are fighting the gas room burning torch
                if (checkIndex(inventory, 10)) {
                    message += "\<br\>The gas in the room is ignited by the torch - You become a human BBQ and die!";
                    hits = 0;
                }
            }
            DisplayGameScreen();
        }

        function ProcessCommand(command) {
            var direction = command;
            message = "OK";
            switch (command) {
                //Movement Code
                case "N":
                    if (exits[currentRoom].indexOf(direction) > -1)
                        currentRoom -= 8;
                    else
                        message = "Can't move there";
                    break;
                case "S":
                    if (exits[currentRoom].indexOf(direction) > -1)
                        currentRoom += 8;
                    else
                        message = "Can't move there";
                    break;
                case "E":
                    if (exits[currentRoom].indexOf(direction) > -1)
                        currentRoom++;
                    else
                        message = "Can't move there";
                    break;
                case "W":
                    if (exits[currentRoom].indexOf(direction) > -1)
                        currentRoom--;
                    else
                        message = "Can't move there";
                    break;
                    //End of Movement Code
                case "P":
                    pickup(currentRoom);
                    break
                case "A":
                    if (exits[currentRoom].indexOf(direction) > -1)
                        message = "About ... Game built for #1GAM, LD48 (failed) and my friend Hilary";
                    break
                case "?":
                    message = "The following commands are valid: N S E W P A ?";
                    break
            }
        }
        //JQuery selector that handles the form submit - 
        $('#input form').submit(function (evt) {
            ProcessGameRound($('#userInput').val().toUpperCase());

            $('#userInput').val('');
            evt.preventDefault();
        });

        //sets the output div to the display variable
        $display = $('#output');

        // This is jQuery selector that picks up an event from the button - in this case we look at the value of the button ie. its text and use that 
        //to call the same function as we would call from the equivalent keyboard command
        $(".button").click(function (e) {
            switch (this.value) {
                case "N":
                    ProcessGameRound('N');
                    break;
                case "S":
                    ProcessGameRound('S');
                    break;
                case "E":
                    ProcessGameRound('E');
                    break;
                case "W":
                    ProcessGameRound('W');
                    break;
                case "F":
                    ProcessGameRound('F');
                    break;
                case "P":
                    pickup(currentRoom);
                    break;
                case "A":
                    ProcessGameRound('A');
                    break;
            }
        });

        DisplayGameScreen();

    });
</script>