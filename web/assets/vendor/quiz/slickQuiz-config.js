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
            "correct": "<p><span>Correcto!</span> Git es un DVCS!</p>",
            "incorrect": "<p><span>Uhh no.</span> GIT es un controlador de versiones DISTRIBUIDO </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "CVS only tracks changes to single files.  What does Git do??",
            "a": [
                {"option": "Bacon and eggs",               "correct": false},
                {"option": "git tracks entire source trees with a global view",   "correct": true},
                {"option": "Leftover pizza",               "correct": false},
                {"option": "Eggs, fruit, toast, and milk", "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>Nice!</span> Your cholestoral level is probably doing alright.</p>",
            "incorrect": "<p><span>Hmmm.</span> You might want to reconsider your options.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "To set your email address at the global--or user--level, what command would you type?.",
            "a": [
                {"option": "git set --user email <email>",           "correct": false},
                {"option": "git config --global user.email <email>", "correct": true},
                {"option": "git config email <email>",  "correct": false},
                {"option": "git set --user user.email>email", "correct": false} // no comma here
            ],
            "correct": "<p><span>Brilliant!</span> You're seriously a genius, (wo)man.</p>",
            "incorrect": "<p><span>Not Quite.</span> You're actually on Planet Earth, in The Milky Way, At a computer. But nice try.</p>" // no comma here
        },
        { // Question 4
            "q": "Versionar tu código te permite...?",
            "a": [
                {"option": "Trabajar en equipo en el mismo proyecto",    "correct": true},
                {"option": "Tener una lista de modificaciones del código",     "correct": true},
                {"option": "Validar automáticamente la funcionalidad del código de otro desarrollador",      "correct": false},
                {"option": "Conocer quién escribió una linea de código",   "correct": true} // no comma here
            ],
            "select_any": true,
            "correct": "<p><span>Holy bananas!</span> I didn't actually expect you to know that! Correct!</p>",
            "incorrect": "<p><span>Fail.</span> Sorry. You lose. It actually rains approximately 32 inches a year in Michigan.</p>" // no comma here
        },
        { // Question 5
            "q": "¿Cuál es la razón por la que Git puede ser más rápido que otros sistemas?",
            "a": [
                {"option": "El historial del código es local.",    "correct": false},
                {"option": "El historial del código está en la nube.",     "correct": false},
                {"option": "El código no se utiliza completamente.",      "correct": false},
                {"option": "El historial del código está en más de una máquina.",   "correct": true} // no comma here
            ],
            "correct": "<p><span>Holy bananas!</span> I didn't actually expect you to know that! Correct!</p>",
            "incorrect": "<p><span>Fail.</span> Sorry. You lose. It actually rains approximately 32 inches a year in Michigan.</p>" // no comma here
        },
        { // Question 6
            "q": "Hay otras opciones para controlar versiones a parte de GIT?",
            "a": [
                {"option": "Si",    "correct": true},
                {"option": "No",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Good Job!</span> You must be very observant!</p>",
            "incorrect": "<p><span>ERRRR!</span> What planet Earth are <em>you</em> living on?!?</p>" // no comma here
        },
        { // Question 7
            "q": "¿En que año Nació GIT?",
            "a": [
                {"option": "1980",    "correct": false},
                {"option": "2005",    "correct": true},
                {"option": "2000",    "correct": false},
                {"option": "2015",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> You must be very observant!</p>",
            "incorrect": "<p><span>ERRRR!</span> What planet Earth are <em>you</em> living on?!?</p>" // no comma here
        } // no comma here
    ]
};
