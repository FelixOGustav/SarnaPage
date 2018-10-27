window.onload =  function() {SetRandomBibleVers()};

function SetRandomBibleVers(){
    var bibeltext = ["Var som en tjänare som väntar...", "Vilken lott det är att vänta...", "Vänta lite, jag ska snart ge dig besked...", "De befallde dem att vänta...","Låt oss därför tåligt vänta..."];
    var bibelord = ["Lukas 12:36","Job 31:2","Job 36:2", "Apg 4:15","Judit 8:17"]
    var index = Math.floor(Math.random() * bibeltext.length);
    document.getElementById("bibletext").innerText = bibeltext[index];
    document.getElementById("bibleverse").innerText = bibelord[index];
}