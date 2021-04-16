let faceUpCards
let faceDownCard
 
let deck = []
let tiles = []
let flippedCards = []
 
let cooldown = null
 
const rows = 3
const columns = 4
 
class Tile {
 
  constructor(x, y, faceUpImage){
    this.x = x
    this.y = y
    this.width = 175
    this.height = 175
    this.faceUpImage = faceUpImage
    this.faceDownImage = faceDownCard
    this.isFaceUp = false
  }
 
  render() {
    fill(93, 81, 124)
    stroke(0, 0, 0)
    strokeWeight(4)
    rect(this.x, this.y, this.width, this.height, 10)
 
    if (this.isFaceUp){
      image(this.faceUpImage, this.x, this.y, this.width, this.height)
    }
    else{
      image(this.faceDownImage, this.x + 10, this.y + 10, 10, 10)
    }
  }
 
  setIsFaceUp(isFaceUp) {
    this.isFaceUp = isFaceUp
  }
 
  isUnderMouse(x, y) {
    return x >= this.x && x < this.x + this.width && 
      y >= this.y && y < this.y + this.height
  }
}
 
function loadFaceUpCards(){
  faceUpCards = [
    loadImage('assets/maki.png'),
    loadImage('assets/onigiri.png'),
    loadImage('assets/ramen.png'),
    loadImage('assets/rice.png'),
    loadImage('assets/sushi.png'),
    loadImage('assets/tempura.png')
  ]
}
 
function createDeck(images){
  for(let i=0; i < faceUpCards.length; i++){
    deck.push(images[i])
    deck.push(images[i])
  }
 
  // melanger les cartes
  deck.sort(function() {
    return 0.5 - random()
  })
}
 
function createTiles(){
  for(let i=0; i < columns; i++)
  {
    for(let j=0; j < rows; j++)
    {
       // rendre l'image
       let tile = new Tile(
         i * 185 + 10,
         j * 185 + 10,
         deck.pop()
       )
 
       tiles.push(tile)
    }
  }
}
 
function drawResultOnWin() {
  let matches = true
 
  for(let i = 0; i < tiles.length; i++)
  {
    matches = matches && tiles[i].isMatch
  }
 
  if(matches) {
    //code
    fill(0, 0, 0)
    RedirectionJavascript();
  }
}

function RedirectionJavascript(){
  location.replace("gain-tempon.php"); 
}

function setup() {
  createCanvas(1200, 1000)
 
  faceDownCard = loadImage('assets/faceDownImage.png')
 
  loadFaceUpCards()
  createDeck(faceUpCards)
  createTiles()
}
 
function updateLogic() {
  if(cooldown && frameCount - cooldown > 30){
    for(let i = 0; i < tiles.length; i++) 
    {
      if(!tiles[i].isMatch && tiles[i].isFaceUp){
         tiles[i].setIsFaceUp(false)
      }
    }
 
    // remettre la liste de cartes flipped
    flippedCards = []
    cooldown = null
  }
}
 
function draw() {
  updateLogic()
  for(let i = 0; i < tiles.length; i++)
  {
    tiles[i].render()
  }
 
  drawResultOnWin()
}
 
function mouseClicked() {
  for(let i = 0; i < tiles.length; i++)
  {
     if(tiles[i].isUnderMouse(mouseX, mouseY))
     {
       // click sur la carte
       if(flippedCards.length < 2 && !tiles[i].isFaceUp) {
         // retournement de la carte
         tiles[i].setIsFaceUp(true) 
         flippedCards.push(tiles[i])
 
         // verifier si les cartes sont similaire
         if(flippedCards.length === 2){
            if(flippedCards[0].faceUpImage === flippedCards[1].faceUpImage){
              flippedCards[0].isMatch = true
              flippedCards[1].isMatch = true
            }
 
           cooldown = frameCount
         }
 
 
       }
     }
  }
}