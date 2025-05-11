CREATE OR REPLACE FUNCTION modifier_vinyle(
    p_id INTEGER,
    p_titre TEXT,
    p_description TEXT,
    p_prix NUMERIC,
    p_quantite INTEGER,
    p_image TEXT,
    p_categorie_id INTEGER
) RETURNS INTEGER AS
$$
DECLARE
    lignes_modifiees INTEGER;
BEGIN
    UPDATE vinyles
    SET titre = p_titre,
        description = p_description,
        prix = p_prix,
        quantite = p_quantite,
        image_url = p_image,
        categorie_id = p_categorie_id
    WHERE id = p_id;

    GET DIAGNOSTICS lignes_modifiees = ROW_COUNT;

    IF lignes_modifiees = 0 THEN
        RETURN -1;
    ELSE
        RETURN p_id;
    END IF;
END;
$$ LANGUAGE plpgsql;
