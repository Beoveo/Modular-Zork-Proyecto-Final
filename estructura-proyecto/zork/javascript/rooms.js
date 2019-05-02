var rooms = {
    "inicio": {
        description: "Esta oscuro , hace frio y ves una luz al <b>north</b>\
     se oye el sonido del agua al <b>west</b>",
        directions: {
            "north": "room1",
            "west": "room2"
        },
        image:"zork/juegoimg/p1/calabozoOscuro.png"
    },
    "room1": {
        description: "Estas en una habitacion con mas luz , ves una gran sala <b>north</b>\
     y un extraño olor proviene del <b>east</b>",
        directions: {
            "south": "inicio",
            "north": "gransala",
            "east": "trolls"
        },
        image:"zork/juegoimg/p1/calabozocerrado.png"

    },
    "gransala": {
        description: "Esta es la gran sala , al fondo , una anciana abre una puerta <b>anciana</b>\
     ¿Que haces?",
        directions: {
            "south": "room1"
        },
        image:"zork/juegoimg/p2/salaSupClabozo.png",
    },

    "trolls": {
        description: "Llegas a otra habitacion, algunos trolls estan asando comida, atacar\
     no te han visto todavia , ¿Que haces?",
        directions: {
            "west": "room1"
        },
        image:"zork/juegoimg/p2/salaSupClabozoEste.png"
    },
    "room2": {
        description: "Por la ventana al <b>west</b> se ve una puente que parece que da a la salida de esto",
        directions: {
            "east": "inicio",
            "west": "room3"
        },
        image:"zork/juegoimg/p2/salaSupClabozoEsteSinOrco.png"

    },
    "room3": {
        description: "Al intentar cruzar la habitacion , un troll te salta y te ataca, ¿Que haces?",
        directions: {
            "east": "room2"
        },
        image:"zork/juegoimg/p2/salaSupClabozoEste.png"
    }
}
