CREATE OR REPLACE FUNCTION supprimer_vinyle(p_id INTEGER) RETURNS INTEGER AS
$$
DECLARE
    lignes_supprimees INTEGER;
BEGIN
    DELETE FROM vinyles WHERE id = p_id;

    GET DIAGNOSTICS lignes_supprimees = ROW_COUNT;

    IF lignes_supprimees = 0 THEN
        RETURN -1;
    ELSE
        RETURN p_id;
    END IF;
END;
$$ LANGUAGE plpgsql;
