/// <reference types="cypress" />

import { loginFunction } from "./login.cy";

describe("Crud Genre", () => {
    it("Create Data Genre", () => {
        loginFunction();
        cy.get(":nth-child(6) > .nav-link").click();
        cy.get('[href="http://127.0.0.1:8000/dashboard/genres"]').click();
        cy.get("a.btn").contains("Create new Film Genre").click();
        cy.get("#genre_name")
            .should("have.class", "form-control")
            .type("Test Genres");
        cy.get(".mb-5 > form > .btn").contains("Add New Genre").click();
    });

    it("Update Data Genre", () => {
        loginFunction();
        cy.get(":nth-child(6) > .nav-link").click();
        cy.get('[href="http://127.0.0.1:8000/dashboard/genres"]').click();
        cy.get(":nth-child(1) > :nth-child(3) > .btn-warning").click();
        cy.get("#genre_name").clear().type("Test Genre Edit");
        cy.get(".mb-5 > form > .btn").click();
    });

    it("Delete Data Genre", () => {
        loginFunction();
        cy.get(":nth-child(6) > .nav-link").click();
        cy.get('[href="http://127.0.0.1:8000/dashboard/genres"]').click();
        cy.get(":nth-child(3) > :nth-child(3) > .d-inline > .btn").click();
    });
});
