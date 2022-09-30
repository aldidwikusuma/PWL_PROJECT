/// <reference types="cypress" />

export const loginFunction = () => {
    cy.visit("http://127.0.0.1:8000/login");
    cy.get(":nth-child(5) > .py-1").click();
    cy.get("#username").type("aria1234").should("have.class", "form-control");
    cy.get("#email")
        .type("aria1234@gmail.com")
        .should("have.class", "form-control");
    cy.get("#password").type("aria1234").should("have.class", "form-control");
    cy.get("#password-confirm")
        .type("aria1234")
        .should("have.class", "form-control");
    cy.get(".btn")
        .click()
        .then(() => {
            if (cy.get("strong").should("be.visible")) {
                cy.get(":nth-child(5) > .py-1").click();
                cy.get("#username")
                    .type("aria1234")
                    .should("have.class", "form-control");
                cy.get("#password")
                    .type("aria1234")
                    .should("have.class", "form-control");
                cy.get("#remember").check();
                cy.get(".btn").click();
            }
        });
    return true;
};

describe("Testing Login", () => {
    it("Register And Login Account", () => {
        loginFunction();
    });
});
