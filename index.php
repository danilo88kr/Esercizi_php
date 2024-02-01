<?php
// ESERCIZIO 1 --PANINO

abstract class Bread
{
    abstract public function breadType();
}

class WholeGrainBread extends Bread
{

    public function breadType()
    {
        echo "- Tipo di pane: Pane integrale\n";
    }
}

class NaturallyLeavenedBread extends Bread
{
    public function breadType()
    {
        echo "- Tipo di pane: Pane a lievitazione naturale \n";
    }
}

class BreadWithCornFlour extends Bread
{
    public function breadType()
    {
        echo "- Tipo di pane: Pane con farina di mais \n";
    }
}

abstract class Protein
{
    abstract public function proteinType();
}

class BeefBurger extends Protein
{
    public function proteinType()
    {
        echo "Proteina: Hamburgher di manzo \n";
    }
}

class Sausage extends Protein
{
    public function proteinType()
    {
        echo "Proteina: Salsiccia Calabrese \n";
    }
}

class Speck extends Protein
{
    public function proteinType()
    {
        echo "Proteina: Speck  \n";
    }
}
class Wrustel extends Protein
{
    public function proteinType()
    {
        echo "Proteina: Wrustel \n";
    }
}

abstract class Dressing
{
    abstract public function dressingType();
}

class BarbecueSauce extends Dressing
{
    public function dressingType()
    {
        echo "- Salsa: Salsa Barbecue \n";
    }
}
class Mayonnaise extends Dressing
{
    public function dressingType()
    {
        echo "-Salsa: Maionese \n";
    }
}

class Worcester extends Dressing
{
    public function dressingType()
    {
        echo "-Salsa: Salsa Worcester \n";
    }
}
// DEPENDENCY INJECTION    

class Sandwich
{
    public $bread, $protein, $dressing;

    public function __construct(Bread $pane, Protein $proteina, Dressing $salsa) 
    {
        $this->bread = $pane;
        $this->protein = $proteina;
        $this->dressing = $salsa;
    }

    public function printBread()
    {
      
        $this->bread->breadType();
    }
    public function printProtein()
    {
        $this->protein->proteinType();
    }

    public function printDressing()
    {
        $this->dressing->dressingType();
    }
}
$pane = new WholeGrainBread();
$tofu = new Sausage();
$pate = new Worcester();

$panino = new Sandwich($pane, $tofu, $pate);


$panino2 = new Sandwich(new NaturallyLeavenedBread(), new Speck(), new BarbecueSauce());
// var_dump($panino2);
// $panino->dressingType();
$panino->printBread();
$panino2->printBread();
$panino->printDressing();
$pane2 = new NaturallyLeavenedBread();
$panino3 = new Sandwich($pane2, new Speck(), new BarbecueSauce());
var_dump($panino2, $panino);

// ESERCIZIO 2 -- CASA

class Tetto {
    private $materiale;

    public function __construct($materiale) {
        $this->materiale = $materiale;
    }

    public function getMateriale() {
        return $this->materiale;
    }
}

class Mura {
    private $materiale;

    public function __construct($materiale) {
        $this->materiale = $materiale;
    }

    public function getMateriale() {
        return $this->materiale;
    }
}

class Pavimenti {
    private $tipo;

    public function __construct($tipo) {
        $this->tipo = $tipo;
    }

    public function getTipo() {
        return $this->tipo;
    }
}


class Casa {
    private $tetto;
    private $mura;
    private $pavimenti;

    public function __construct(Tetto $tetto, Mura $mura, Pavimenti $pavimenti) {
        $this->tetto = $tetto;
        $this->mura = $mura;
        $this->pavimenti = $pavimenti;
    }

    public function getDettagliCasa() {
        $dettagli = [
            'Materiale del tetto' => $this->tetto->getMateriale(),
            'Materiale delle mura' => $this->mura->getMateriale(),
            'Tipo di pavimenti' => $this->pavimenti->getTipo(),
        ];

        return $dettagli;
    }
}



$tetto = new Tetto("Tegole");
$mura = new Mura("Cemento");
$pavimenti = new Pavimenti("Legno");


$miaCasa = new Casa($tetto, $mura, $pavimenti);

$dettagliCasa = $miaCasa->getDettagliCasa();

foreach ($dettagliCasa as $attributo => $valore) {
    echo "$attributo: $valore\n";
}


// ESECIZIO 3 -- ESERCITO 

interface Attack {
    public function executeAttack();
}


interface Defense {
    public function executeDefense();
}


class BasicAttack implements Attack {
    public function executeAttack() {
        echo "Attacco di base!\n";
    }
}


class BasicDefense implements Defense {
    public function executeDefense() {
        echo "Difesa di base!\n";
    }
}


class Army {
    private $attack;
    private $defense;

    public function __construct(Attack $attack, Defense $defense) {
        $this->attack = $attack;
        $this->defense = $defense;
    }

    public function engage() {
        echo "L'esercito è pronto a combattere!\n";
        $this->attack->executeAttack();
        $this->defense->executeDefense();
    }
}


class FantasyAttack extends BasicAttack {
    public function executeAttack() {
        echo "Attacco fantasy!\n";
    }
}


class FantasyDefense extends BasicDefense {
    public function executeDefense() {
        echo "Difesa fantasy!\n";
    }
}


$basicAttack = new BasicAttack();
$basicDefense = new BasicDefense();

$fantasyAttack = new FantasyAttack();
$fantasyDefense = new FantasyDefense();


$basicArmy = new Army($basicAttack, $basicDefense);
$fantasyArmy = new Army($fantasyAttack, $fantasyDefense);


$basicArmy->engage();


$fantasyArmy->engage();