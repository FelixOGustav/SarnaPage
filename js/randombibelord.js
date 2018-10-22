window.onload =  function() {SetRandomBibleVers()};

function SetRandomBibleVers(){
    var bibelord = ["första", "andra", "etc"];
    var index = Math.floor(Math.random() * bibelord.length);
    console.log(bibelord[index]);
    document.getElementById("bibleverse").innerText = bibelord[index];
}