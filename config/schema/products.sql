CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    last_updated DATETIME NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME,
    modified DATETIME
);
CREATE INDEX idx_product_name ON products(name);
CREATE INDEX idx_product_status ON products(status);
CREATE INDEX idx_product_deleted ON products(deleted);
