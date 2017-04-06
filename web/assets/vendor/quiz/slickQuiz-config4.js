// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Cuarto Quiz",
        "main":    "<p>Vamos a encender nuestros conocimientos a través de este 4to presente Quiz.  El mismo estará disponible una vez hayas aprendido la arquitectura de Git</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Que sucede si ejecutamos el comando git log sin ninguna opción?",
            "a": [
                {"option": "muestra el estatus del proyecto",      "correct": false},
                {"option": "muestra la confirmación mas reciente",     "correct": false},
                {"option": "muestra todas las confirmaciones cronologicamente inversa",      "correct": true},
                {"option": "muestra un error en la pantalla",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Correcto: El comando git log sin opciones muestra todo el historial empezando desde el mas reciente hasta el primer commit realizado en el proyecto.</p>",
            "incorrect": "<p><span>Uhh no.</span> El comando git log sin opciones muestra todo el historial empezando desde el mas reciente hasta el primer commit realizado en el proyecto. </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "¿Es cierto que podemos modificar lo que muestra el comando git log?",
            "a": [
                {"option": "Verdadero",               "correct": true},
                {"option": "Falso",   "correct": false}
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> Con las opciones y los parametros podemos tener el control de lo que muestra y como lo muestra</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> recuerda la parte de los parametros y opciones.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "¿Puedo ejecutar varios parametros a la vez?",
            "a": [
                {"option": "Cierto",           "correct": true},
                {"option": "Falso'", "correct": false}

            ],
            "correct": "<p><span>Brillante!</span> con varios parametros te aseguras que lo que estas buscando se te sea mostrado como lo necesitas</p>",
            "incorrect": "<p><span>Incorrecto.</span> Puedes colocar tantos parametros como necesites para encontrar lo que buscas.</p>" // no comma here
        },
        { // Question 4
            "q": "Si quiero que me aparezcan las confirmaciones desde una fecha hasta el presente, ¿Cuál sería el paremetro?",
            "a": [
                {"option": "--author",           "correct": false},
                {"option": "--since",           "correct": true},
                {"option": "--grep",           "correct": false},
                {"option": "--until",     "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Tienes el control y el super poder de controlar la historia del proyecto</p>",
            "incorrect": "<p><span>Falla.</span> te falta repasar el camino para adquirir este super poder.!</p>" // no comma here
        }
    ]
};
