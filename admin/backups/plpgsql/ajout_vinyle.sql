CREATE OR REPLACE FUNCTION ajout_vinyle(
    p_titre TEXT,
    p_description TEXT,
    p_prix NUMERIC,
    p_quantite INTEGER,
    p_image TEXT,
    p_categorie_id INTEGER
) RETURNS INTEGER AS
$$
DECLARE
    retour INTEGER;
BEGIN
    INSERT INTO vinyles (titre, description, prix, quantite, image_url, categorie_id)
    VALUES (p_titre, p_description, p_prix, p_quantite, p_image, p_categorie_id)
    RETURNING id INTO retour;

    IF retour IS NULL THEN
        RETURN -1;
    ELSE
        RETURN retour;
    END IF;
END;
$$ LANGUAGE plpgsql;
