<?php










class ElementFormation {

    private $id;
    private $sem_seq;
    private $sem_label;
    private $sigle;
    private $categorie;
    private $affectation;
    private $utt;
    private $profil;
    private $credit;
    private $resultat;


    function __construct($donnes) {

          $this->hydrate($donnes);




    }

    /*public function __destruct() {
        echo ">> class module : destruct ($this->id, $this->sem_seq,$this->sem_label,$this->sigle,$this->categorie, $this->affectation,$this->utt,$this->profil,$this->credit, $this->resultat) <br/>\n";
    }*/

    public function __toString() {
        return "Elément de formation : $this->id, $this->sem_seq, $this->sem_label, "
                . "$this->sigle, $this->categorie, $this->affectation, $this->utt,"
                . " $this->profil, $this->credit, $this->resultat.";
    }

    function getId() {
        return $this->id;
    }

    function getSem_seq() {
        return $this->sem_seq;
    }

    function getSem_label() {
        return $this->sem_label;
    }

    function getSigle() {
        return $this->sigle;
    }

    function getCategorie() {
        return $this->categorie;
    }

    function getAffectation() {
        return $this->affectation;
    }

    function getUtt() {
        return $this->utt;
    }

    function getProfil() {
        return $this->profil;
    }

    function getCredit() {
        return $this->credit;
    }

    function getResultat() {
        return $this->resultat;
    }

    function setId(string $id) {
        $this->id = $id;
    }

    function setSem_seq(int $sem_seq) {
        $this->sem_seq = $sem_seq;
    }

    function setSem_label(string $sem_label) {
        $this->sem_label = $sem_label;
    }

    function setSigle(string $sigle) {
        $this->sigle = $sigle;
    }

    function setCategorie(string $categorie) {
        $this->categorie = $categorie;
    }

    function setAffectation(string $affectation) {
        $this->affectation = $affectation;
    }

    function setUtt($utt) {
        if ($utt === "Y" || $utt === "N") {
            $this->utt = $utt;
        }
    }

    function setProfil($profil) {
        if ($profil === "Y" || $profil === "N") {
            $this->profil = $profil;
        }
    }

    function setCredit(int $credit) {
        $this->credit = $credit;
    }

    function setResultat(string $resultat) {
        $this->resultat = $resultat;
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

}

?>
