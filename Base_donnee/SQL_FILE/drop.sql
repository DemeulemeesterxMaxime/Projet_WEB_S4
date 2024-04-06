USE jreuttus_projet_web;
ALTER TABLE module DISABLE KEYS;
ALTER TABLE matiere DISABLE KEYS;
ALTER TABLE admin DISABLE KEYS;
ALTER TABLE eleve DISABLE KEYS;
ALTER TABLE eval DISABLE KEYS;
ALTER TABLE eval_eleve DISABLE KEYS;
ALTER TABLE eleve_matiere DISABLE KEYS;
ALTER TABLE eleve_module DISABLE KEYS;

DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS eval_eleve;
DROP TABLE IF EXISTS eleve_matiere;
DROP TABLE IF EXISTS eleve_module;
DROP TABLE IF EXISTS eval;
DROP TABLE IF EXISTS eleve;
DROP TABLE IF EXISTS matiere;
DROP TABLE IF EXISTS module;