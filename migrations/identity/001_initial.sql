CREATE SCHEMA IF NOT EXISTS identity;
CREATE TABLE identity.account (
    id bigint GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    email varchar(254) NOT NULL UNIQUE,
    display_name varchar(100) NOT NULL,
    password_hash text NOT NULL,
    access_role varchar(16) NOT NULL DEFAULT 'user' CHECK (access_role IN ('user', 'moderator', 'admin')),
    is_active boolean NOT NULL DEFAULT true,
    created_at timestamptz NOT NULL DEFAULT now()
);
CREATE TABLE identity.community_role (
    id bigint GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    account_id bigint NOT NULL REFERENCES identity.account(id) ON DELETE CASCADE,
    role varchar(32) NOT NULL CHECK (role IN ('speaker', 'volunteer')),
    starts_at timestamptz NOT NULL,
    expires_at timestamptz NOT NULL CHECK (expires_at > starts_at),
    assigned_by bigint REFERENCES identity.account(id) ON DELETE SET NULL,
    revoked_at timestamptz,
    created_at timestamptz NOT NULL DEFAULT now()
);
CREATE INDEX community_role_account_idx ON identity.community_role (account_id, role);
CREATE TABLE identity.login_throttle (
    key_hash char(64) PRIMARY KEY,
    attempts integer NOT NULL,
    window_started_at timestamptz NOT NULL
);
