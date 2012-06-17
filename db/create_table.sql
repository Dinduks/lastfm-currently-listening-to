CREATE table users(
    username   varchar(255),
    updated_at timestamp,
    UNIQUE (username)
);
