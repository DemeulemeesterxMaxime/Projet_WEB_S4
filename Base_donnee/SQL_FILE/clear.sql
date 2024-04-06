-- Désactiver les contraintes de clé étrangère pour la table "eval_eleve"
ALTER TABLE eval_eleve DISABLE KEYS;

ALTER TABLE eval DISABLE KEYS;

-- Vider la table "eval_eleve"
DELETE FROM eval_eleve;

-- Vider la table "eval"
DELETE FROM eval;

UPDATE eleve_matiere SET moyenne_matiere = NULL;
UPDATE eleve_module SET moyenne_module = NULL;
-- Réactiver les contraintes de clé étrangère pour la table "eval_eleve"
ALTER TABLE eval_eleve ENABLE KEYS;
ALTER TABLE eval ENABLE KEYS;


