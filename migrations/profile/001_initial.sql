CREATE SCHEMA IF NOT EXISTS profile;
CREATE TABLE profile.points_event (
    id bigint GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    account_id bigint NOT NULL REFERENCES identity.account(id) ON DELETE CASCADE,
    event_key varchar(128) NOT NULL,
    points integer NOT NULL CHECK (points > 0),
    reason varchar(255) NOT NULL CHECK (length(trim(reason)) > 0),
    created_at timestamptz NOT NULL DEFAULT now(),
    UNIQUE (account_id, event_key)
);
