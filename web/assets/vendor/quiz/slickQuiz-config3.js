// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Tercer Quiz",
        "main":    "<p>Vamos a encender nuestros conocimientos a través del presente Quiz.  El mismo estará disponible una vez hayas aprendido la arquitectura de Git</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Cuantos árboles maneja la arquitectura de Git?",
            "a": [
                {"option": "Cuatro",      "correct": false},
                {"option": "Dos",     "correct": false},
                {"option": "Uno",      "correct": false},
                {"option": "Tres",     "correct": true} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Correcto: el Working Directory, el Stage Index y el Repositorio.</p>",
            "incorrect": "<p><span>Uhh no.</span> Recuerda que son tres: el Working Directory, el Stage Index y el Repositorio. </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "Cuando uno añade un archivo nuevo a un repositorio Git, ¿Que estatus se le asigna?",
            "a": [
                {"option": "Modificado",               "correct": false},
                {"option": "Sin Seguimiento",   "correct": true},
                {"option": "Staged",               "correct": false},
                {"option": "Sin Modificaciones", "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> Los archivos que nunca han sido preparados, git los cataloga como sin Seguimiento o Untracked</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> debemos repasar la teoría sobre los estados de los archivos de GIT.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "¿Que estado tiene un archivo que estaba en el Stage y se ejecutó el comando git commit?",
            "a": [
                {"option": "Ninguno",           "correct": true},
                {"option": "Modificado'", "correct": false},
                {"option": "Staged",  "correct": false}

            ],
            "correct": "<p><span>Brillante!</span> Conoces como Git trabaja y asigna estatus.  No muestra nada ya que ese archivo en el working y el repositorio, tienen la misma información</p>",
            "incorrect": "<p><span>Incorrecto.</span> debemos repasar la teoría sobre los estados de los archivos de GIT.</p>" // no comma here
        },
        { // Question 4
            "q": "¿Que sucede si un archivo que está en el repositorio es modificado en el working?",
            "a": [
                {"option": "Nada",           "correct": false},
                {"option": "Sin Seguimiento",           "correct": false},
                {"option": "Modificado",     "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Ya manejas muy bien la teoría de Git</p>",
            "incorrect": "<p><span>Falla.</span> Lo siento. el Archivo se le asigna el estado de Modificado.!</p>" // no comma here
        }
    ]
};
