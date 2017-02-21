// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Primer Quiz",
        "main":    "<p>Vamos a encender nuestros conocimientos a través del presente Quiz.  El mismo estará disponible una vez hayas obtenido los dos primeros logros de este curso</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Qué es GIT?",
            "a": [
                {"option": "Un Lenguaje de Programación",      "correct": false},
                {"option": "Un Gestor de Base de Datos",     "correct": false},
                {"option": "Un Controlador de Versiones Distribuido",      "correct": true},
                {"option": "Una Banda de música",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Git es un Controlador de Versiones distribuido (DVCS por sus siglas en Ingles)</p>",
            "incorrect": "<p><span>Uhh no.</span> GIT es un controlador de versiones DISTRIBUIDO.  Recuerda ver las animaciones para entender la diferencia entre los tipos de controladores de versiones </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "Los controladores de versiones centralizados y locales guardan los cambios a cada archivo.  ¿Cómo lo hace GIT?",
            "a": [
                {"option": "A cada archivo individualmente",               "correct": false},
                {"option": "Todo el directorio del repositorio con una vista global",   "correct": true},
                {"option": "a un grupo por separado",               "correct": false},
                {"option": "Todas las anteriores", "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> Git guarda fotografías del directorio de manera global y si se mantiene igual, guarda es una referencia al estado.</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> Creo que debes repasar la teoría y luego reconsiderar las opciones.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "Para registar el correo del usuario git a nivel global, ¿Que comandos deberíamos usar?.",
            "a": [
                {"option": "git set --user email <email>",           "correct": false},
                {"option": "git config --global user.email <email>", "correct": true},
                {"option": "git config email <email>",  "correct": false},
                {"option": "git set --user user.email>email", "correct": false} // no comma here
            ],
            "correct": "<p><span>Brillante!</span> de verdad ya sabes configurar los aspectos básicos para trabajar con GIT.</p>",
            "incorrect": "<p><span>Incorrecto.</span> Debemos repasar los comandos de configuración.</p>" // no comma here
        },
        { // Question 4
            "q": "Versionar tu código te permite...? (debes seleccionar todas las correctas)",
            "a": [
                {"option": "Trabajar en equipo en el mismo proyecto",    "correct": true},
                {"option": "Tener una lista de modificaciones del código",     "correct": true},
                {"option": "Validar automáticamente la funcionalidad del código de otro desarrollador",      "correct": false},
                {"option": "Conocer quién escribió una linea de código",   "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> No pensé que fueras a responder esta de manera correcta! Felicitaciones!</p>",
            "incorrect": "<p><span>Falla.</span> Lo siento.</p>" // no comma here
        },
        { // Question 5
            "q": "¿Cuál es la razón por la que Git puede ser más rápido que otros sistemas?",
            "a": [
                {"option": "El historial del código es únicamente local.",    "correct": false},
                {"option": "El historial del código está en la nube.",     "correct": false},
                {"option": "El código no se utiliza completamente.",      "correct": false},
                {"option": "El historial del código está en más de una máquina.",   "correct": true} // no comma here
            ],
            "correct": "<p><span>Excelente!</span> Felicitaciones, con git el código y el historial está en cada maquina que participe ! </p>",
            "incorrect": "<p><span>Incorrecto.</span> Recuerda que con git el código y el historial está en cada maquina que participe .</p>" // no comma here
        },
        { // Question 6
            "q": "Hay otras opciones para controlar versiones a parte de GIT?",
            "a": [
                {"option": "Si",    "correct": true},
                {"option": "No",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Muy Bien!</span> Git no es el único que existe hay otros sistemas (centralizados o distribuidos) que se pueden usar!</p>",
            "incorrect": "<p><span>ERRRR!</span>Git no es el único que existe hay otros sistemas (centralizados o distribuidos) que se pueden usar </p>" // no comma here
        },
        { // Question 7
            "q": "¿En que año Nació GIT? (es facil, está en la revista... la leistes????)",
            "a": [
                {"option": "1980",    "correct": false},
                {"option": "2005",    "correct": true},
                {"option": "2000",    "correct": false},
                {"option": "2015",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Eres muy observador!</p>",
            "incorrect": "<p><span>ERRRR!</span> Leistes la revista....?????</p>" // no comma here
        } // no comma here
    ]
};
