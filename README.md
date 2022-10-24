# TODO
Vamos focar-nos apenas na versão inglesa, ou seja, o index.html e o dictGame.php e os respetivos style sheets indexStyle.css e gameStyle.css

index.html: 
- Debaixo das regras adicionar um form com method="POST" e action="dictGame.php" com um input de texto com name="baseWord" e o placeholder="Base Word" e um botão de submit com name="submit" e value="Submit" a dizer "Choose Word"

dictGame.php: 
- Mudar o elemento < h3 > das vidas "Lives: 3" do < div > para o < header > para estar ao lado direito do titulo "Dictionary Game English version"

(Isto é tudo ao mesmo nivel)
- No div por um input do tipo texto com id="guess" com o placeholder="Guess"
- Adicionar ao lado do input colocar um botão com id="check" a dizer "Check"
- Adicionar ainda uma legenda vazia encostada ao lado direito com id="baseWord"

(Isto é tudo ao mesmo nivel, debaixo dos elementos anteriores)
- Adicionar uma legenda oculta (visibility="hidden" penso eu) com id="gameOverL" a dizer "Game Over" encostado à esquerda e outra com id="gameOverR" a dizer "Game Over" encostada à direita
- Adicionar um < a > oculto a dizer "Play Again" que nos leva à pagina principal quando clicado (index.html) no centro
 
(Isto pode no mesmo < div > ou em 2 separados, debaixo dos elementos anteriores) 
- Do lado direito colocar uma legenda a dizer "Correct Guesses", do lado esquerdo "Wrong Guesses"
- Colocar 2 lista não ordenadas < ul > por baixo de cada legenda
  
(Isto é debaixo de todos os elementos)
- Adicionar um botão oculto com id="showAll" a dizer "Show all words"

Todos os elementos que não estão escritos aqui podem ser tirados


# Game Rules
1º Choose a base word with a minimum of 4 letters

2º Try to guess as many words as possible that can be written with the letters of the base word

3º You only have 3 lives! If you write an invalid or non-existent word you loose a life

# Game Example
Base Word: parent

Correct Guesses: part, net, pet, tap

Wrong Guesses: partner (the base word only has 1 letter 'r' and not 2), dog (the base word has none of those letters), tnerap (word doesn't exist)

# Language
The game can be played in both english and portuguese. 

The structure of the web page is the same for the 2 languages but the database for the words is (obviously) different.

