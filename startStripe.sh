#!/bin/bash
stripe listen --forward-to localhost:8000/stripe/webhook &
