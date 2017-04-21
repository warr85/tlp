// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Quinto Quiz",
        "main":    "<p>Vamos a encender nuestros conocimientos a través de este 5to Quiz.  El mismo estará disponible una vez hayas aprendido la arquitectura de Git</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Que sucede si ejecutamos el comando git diff sin ninguna opción y tenemos archivos modificados en el working y en el stage?",
            "a": [
                {"option": "nos muestra todo lo que ha cambiado",      "correct": false},
                {"option": "no muestra nada",     "correct": false},
                {"option": "solo muestra lo que ha cambiado en el Stage",      "correct": false},
                {"option": "Solo muestra lo que ha cambiado en el Working",     "correct": true} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Correcto: El comando git diff sin opciones muestra todo las diferencias que tienen los archivos entre el repositorio y el working.</p>",
            "incorrect": "<p><span>Uhh no.</span> El comando git diff sin opciones muestra todo las diferencias que tienen los archivos entre el repositorio y el working. </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "¿Podemos ver los cambios que hay entre el Stage y el Repositorio?",
            "a": [
                {"option": "Verdadero",               "correct": true},
                {"option": "Falso",   "correct": false}
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> Con la opción --staged podemos ver esas diferencias</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> recuerda que Con la opción --staged podemos ver esas diferencias.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "¿Que sucede si el repositorio está limpio y ejecutamos git diff?",
            "a": [
                {"option": "muestra los ultimos cambios realizados",           "correct": false},
                {"option": "no muestra nada'", "correct": true},
                {"option": "ninguna de las anteriores'", "correct": false}

            ],
            "correct": "<p><span>Brillante!</span> El comando solo muestra las diferencias entre el Repositorio y el Working, de no haber diferencias, no muestra nada</p>",
            "incorrect": "<p><span>Incorrecto.</span> Recuerda que comando solo muestra las diferencias entre el Repositorio y el Working, de no haber diferencias, no muestra nada.</p>" // no comma here
        },
        { // Question 4
            "q": "¿Que sucede si el repositorio está limpio y ejecutamos git diff?",
            "a": [
                {"option": "muestra los ultimos cambios realizados",           "correct": false},
                {"option": "Muestra lo ultimo añadido al stage", "correct": false},
                {"option": "ninguna de las anteriores'", "correct": true}

            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Para responder estas preguntas debes tener un gran conocimiento sobre la estructura y funcionamiento de GIT</p>",
            "incorrect": "<p><span>Falla.</span> Se que es un poco confuso, pero respansando lo vamos a lograr.!</p>" // no comma here
        }
    ]
};
