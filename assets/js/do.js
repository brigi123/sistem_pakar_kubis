var allQuestions = [{question: "Q1: What is your name?", <!-- javascript -->
                    choices: ["Steve", "kevin", "peter", "jimmy"],
                    correctAnswer:0},
    {question: "Q2: when were you born?",
     choices: ["1970", "1982", "1985", "1980"],
    correctAnswer:1},
    {question: "Q3, where were you born?",
    choices: ["Seoul", "New York", "Tokyo", "LA"],
    correctAnswer:0},
    {question: "Q4: what is your passion?",
    choices: ["scientist", "bus driver", "programmer", "teacher"],
    correctAnswer:2},
    {question: "Q5: how many kids do you have?",
    choices: ["1", "2", "0", "none of above"],
    correctAnswer:0}];
var score=0;
var currentNumber = 0;
function createQuestion(){
    for (var i=0; i < allQuestions[this.currentNumber].choices.length;i++){
        document.forms.radioAnswers.elements.choice[i].checked = false;
    }
    var question=document.getElementById("question");
    question.innerHTML = allQuestions[this.currentNumber].question;
    var point  = document.getElementById("point");
    point.innerHTML="<span>score: "+score+"</span>";
    createChoices();
}
function createChoices(){
    for (var i = 0; i < allQuestions[this.currentNumber].choices.length; i++){
        var option=document.getElementById("label"+i);
            option.innerHTML=allQuestions[this.currentNumber].choices[i];
    }
}
function nextQuestion(){
    for (var i =0; i < allQuestions[this.currentNumber].choices.length; i++){
        if (document.forms.radioAnswers.elements.choice[i].checked == true){
            var userAnswer = document.forms.radioAnswers.elements.choice[i].value;
            if (userAnswer == allQuestions[this.currentNumber].correctAnswer){
            this.score++;
            }
        }
    }
    this.currentNumber++;
    if (this.currentNumber==allQuestions.length){ 
        showScore();       
    }
    else{
        createQuestion();
    }
}
function showScore(){
    document.forms.radioAnswers.style.display="none";
    var question=document.getElementById("question");
    question.style.display = "none";
    var elt=document.getElementById("point");
    elt.style.display = "block"; 
    var button = document.getElementById("next");
    button.style.display="none";   

}

window.onload= createQuestion();<--javascript-->